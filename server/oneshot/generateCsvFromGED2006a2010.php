<?php

// set utf-8 encoding
header('Content-type: text/plain; charset=utf-8');

// load WP Core
require_once '../wp-load.php';

// associated "matiere"
$associatedMat = array();
$matieres = mvc_model('Matiere')->find();
foreach ($matieres as $matiere) {
    $associatedMat[$matiere->short_label] = $matiere->code;
}

// associated support
$associatedSupport = array(
    'Let.'  => 1,
    'Diane'  => 4,
    'Nofac'  => 5,
    '48H'  => 6,
    'UR48'  => 6,
    'UR48H'  => 6,
    'SEM'  => 7,
    'URSEM'  => 7,
);

// Indexes in parsed XML files using "simplexml_load_file"
$indexes = array(
    /* index SRENUM  */
    'SRENUM'            => 1,
    /* index SRENUM  */
    'CRPCEN'            => 2,
    /* index Objet  */
    'OBJET'             => 14,
    /* index matiere  */
    'MATIERE'           => 4,
    /* index Juriste  */
    'JURISTE'           => 8,
    /* index Support  */
    'SUPPORT'           => 5,
    /* index Date affectation  */
    'DATE_AFFECTATION'  => 6,
    /* index Date de reponse  */
    'DATE_REPONSE'      => 7,
    /* index Suite  */
    'SUITE'             => 9,
);

// LOG
$errorDocList = array();

// documents
$Directory  = new RecursiveDirectoryIterator(CONST_IMPORT_DOCUMENT_ORIGINAL_PATH);
$Iterator   = new RecursiveIteratorIterator($Directory);
$documents  = new RegexIterator($Iterator, '/^.+\.xml$/i', RecursiveRegexIterator::GET_MATCH);

// total of items (XMLs)
$nbItems    = iterator_count($documents);
// offset block
$limit      = 1000;

// init flag
$i = 0;

// wp default upload dir
$uploadDir = wp_upload_dir();

// instance of csvparser
$csv = new parseCSV();
$csv->delimiter = ";";

/**
 * Create or update CSV
 *
 * @param int $i
 * @param int $nbItems
 * @param mixed $Iterator
 * @param mixed $csv
 * @param mixed $associatedSupport
 * @param mixed $indexes
 * @param mixed $uploadDir
 * @param mixed $errorDocList
 * @param int $limit
 */
function createOrUpdateCsvFile($i, $nbItems, $Iterator, $csv, $associatedSupport, $indexes, $uploadDir, $errorDocList, $limit) {
    // init data
    $data = array();

    // repeat action until limit max
    if ($i <= $nbItems) {

        $documents  = new RegexIterator($Iterator, '/^.+\.xml$/i', RecursiveRegexIterator::GET_MATCH);
        $offset    = $limit + 1;
        foreach(new LimitIterator($documents, 0, $offset) as $document) {
            $contents = array();
            try{
                $crxml = simplexml_load_file($document[0]);

                // valid XML File
                if(!method_exists($crxml->Index_Document[$indexes['SRENUM']]->VALEUR_NUMERIQUE, '__toString')
                   || !method_exists($crxml->Index_Document[$indexes['SRENUM']]->ID_INDEX, '__toString')
                   || !method_exists($crxml->Index[$indexes['SRENUM']]->ID_INDEX, '__toString')){
                    throw new \ErrorException('Il y a une erreur dans le fichier '.pathinfo($document[0])['basename']. ' ('.$document[0].')');
                }

                $shortLabel = $crxml->Index_Document[$indexes['MATIERE']]->VALEUR_TEXTE->__toString();
                $supportLabel = $crxml->Index_Document[$indexes['SUPPORT']]->VALEUR_TEXTE->__toString();

                $contents[] = intval($crxml->Index_Document[$indexes['SRENUM']]->VALEUR_NUMERIQUE->__toString()); // SRENUM
                $contents[] = $crxml->Index_Document[$indexes['CRPCEN']]->VALEUR_TEXTE->__toString(); // CRPCEN
                $contents[] = utf8_decode($crxml->Index_Document[$indexes['OBJET']]->VALEUR_TEXTE->__toString()); // Objet
                $contents[] = isset($associatedMat[$shortLabel]) ? $associatedMat[$shortLabel] : $shortLabel; // Competence
                $contents[] = utf8_decode($crxml->Index_Document[$indexes['JURISTE']]->VALEUR_TEXTE->__toString()); // Juriste
                $contents[] = isset($associatedSupport[$supportLabel]) ? $associatedSupport[$supportLabel] : $supportLabel; // Support
                $contents[] = 4; // Code affectation
                $contents[] = date('Y-m-d', strtotime($crxml->Index_Document[$indexes['DATE_AFFECTATION']]->VALEUR_DATE->__toString())); // Date Creation
                $contents[] = date('Y-m-d', strtotime($crxml->Index_Document[$indexes['DATE_AFFECTATION']]->VALEUR_DATE->__toString())); // Date affectation
                $contents[] = date('Y-m-d', strtotime($crxml->Index_Document[$indexes['DATE_REPONSE']]->VALEUR_DATE->__toString())); // Date de reponse
                $contents[] = $crxml->Document->NOM_DOC_SOURCE->__toString(); // PDF
                $contents[] = $crxml->Index_Document[$indexes['SUITE']]->VALEUR_TEXTE->__toString(); // Suite

                // data
                $data[] = $contents;

                // rename file to old
                rename($document[0], str_replace(".xml", ".xml.old", $document[0]));
            } catch(Exception $ex) {
                $errorDocList[] = $ex->getMessage();
            }
        }

        if (count($data) > 0) {
            if (!file_exists($uploadDir['basedir'] . '/questions2006_2010.csv')) {
                // create new Csv file with data
                $csv->save($uploadDir['basedir'] . '/questions2006_2010.csv', $data, false, array(
                    'SRENUM',
                    'CRPCEN',
                    'Objet',
                    'Competence',
                    'Juriste',
                    'Support',
                    'Code affectation',
                    'Date Creation',
                    'Date affectation',
                    'Date de reponse',
                    'PDF',
                    'Suite'
                ));
            } else {
                // update Csv file
                $csv->save($uploadDir['basedir'] . '/questions2006_2010.csv', $data, true);
            }
        }

        // increments flag
        $i+=$limit;

        // call import action
        createOrUpdateCsvFile($i, $nbItems, $Iterator, $csv, $associatedSupport, $indexes, $uploadDir, $errorDocList, $limit);

    }
}


/**
 * Restore renamed file name (xml.old to xml)
 *
 * @param mixed $Iterator
 * @param mixed $uploadDir
 */
function restoreRenamedFiles($Iterator, $uploadDir) {
    $documents  = new RegexIterator($Iterator, '/^.+\.xml.old$/i', RecursiveRegexIterator::GET_MATCH);
    foreach($documents as $document) {
        // rename file to old
        rename($document[0], str_replace(".xml.old", ".xml", $document[0]));
    }
    if (file_exists($uploadDir['basedir'] . '/questions2006_2010.csv')) {
        unlink($uploadDir['basedir'] . '/questions2006_2010.csv');
    }
}

// action
$action = '';
if (PHP_SAPI === 'cli') { // script called by CLI
    if (isset($argv[1])) {
        if ($argv[1] === 'restore') { // restore action
            $action = 'restore';
        } else { // change limit condition
            $limit = (intval($argv[1]) > 0) ? intval($argv[1]) : $limit;
        }
    }
} else { // script called by Web
    $action = isset($_GET['action']) ? $_GET['action'] : $action;
    $limit  = isset($_GET['limit']) ? $_GET['limit'] : $limit;
}

// check action
if ($action === 'restore') {
    // restore renamed file
    restoreRenamedFiles($Iterator, $uploadDir);

    echo "Restauration OK";
} else {
    // create of update csv file
    createOrUpdateCsvFile($i, $nbItems, $Iterator, $csv, $associatedSupport, $indexes, $uploadDir, $errorDocList, $limit);

    // logs
    writeLog($errorDocList, 'import2006_2010.log');

    echo "Generation CSV OK";
}