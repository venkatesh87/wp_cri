<?php
/**
 * Description of const.inc.php
 * @package wp_cridon
 * @author Etech
 * @contributor Joelio
 */

/**
 * @var $env string will determine if dev, preprod or prod mode is active. Value must be set via SERVER or putenv in wp-config
 */
$env = getenv('ENV');
define('DEV', 'DEV');
define('LOCAL', 'LOCAL');
define('PROD', 'PROD');
define('PREPROD', 'PREPROD');

// notaire role
if ( !defined( 'CONST_NOTAIRE_ROLE' ) ) {
    define( 'CONST_NOTAIRE_ROLE', 'notaire' );
}
if ( !defined( 'CONST_CONNAISANCE_ROLE' ) ) {
    define( 'CONST_CONNAISANCE_ROLE', 'accesconnaissance' );
}
if ( !defined( 'CONST_COLLABORATEUR_TAB_ROLE' ) ) {
    define( 'CONST_COLLABORATEUR_TAB_ROLE', 'accesongletcollaborateur' );
}
if ( !defined( 'CONST_FINANCE_ROLE' ) ) {
    define( 'CONST_FINANCE_ROLE', 'accesfinances' );
}
if ( !defined( 'CONST_QUESTIONECRITES_ROLE' ) ) {
    define( 'CONST_QUESTIONECRITES_ROLE', 'accesquestecrites' );
}
if ( !defined( 'CONST_QUESTIONTELEPHONIQUES_ROLE' ) ) {
    define( 'CONST_QUESTIONTELEPHONIQUES_ROLE', 'accesquesttelephoniques' );
}
if ( !defined( 'CONST_MODIFYOFFICE_ROLE' ) ) {
    define( 'CONST_MODIFYOFFICE_ROLE', 'modifyoffice' );
}
if ( !defined( 'CONST_CRIDONLINESUBSCRIPTION_ROLE' ) ) {
    define( 'CONST_CRIDONLINESUBSCRIPTION_ROLE', 'cridonlinesubscription' );
}
if ( !defined( 'CONST_NOTAIRE_DIV_ROLE' ) ) {
    define( 'CONST_NOTAIRE_DIV_ROLE', 'notaire_div' );
}
if ( !defined( 'CONST_NOTAIRE_ORG_ROLE' ) ) {
    define( 'CONST_NOTAIRE_ORG_ROLE', 'notaire_org' );
}
// administrator role
if ( !defined( 'CONST_ADMIN_ROLE' ) ) {
    define( 'CONST_ADMIN_ROLE', 'administrator' );
}
if ( !defined( 'CONST_LOGIN_SEPARATOR' ) ) {
    define( 'CONST_LOGIN_SEPARATOR', '~' );
}

// wpmvc prefix
if ( !defined( 'CONST_WPMVC_PREFIX' ) ) {
    define( 'CONST_WPMVC_PREFIX', 'mvc_' );
}

// ODBC
if ( !defined( 'CONST_ODBC_DRIVER' ) ) {
    define( 'CONST_ODBC_DRIVER', '{MySQL ODBC 5.3 Ansi Driver}' );
}

if ( !defined( 'CONST_DB_DEFAULT' ) ) {
    define('CONST_DB_DEFAULT', 'MySQL');
}

if ( !defined( 'CONST_DB_ORACLE' ) ) {
    define('CONST_DB_ORACLE', 'oracle');
}
if ( !defined( 'CONST_DB_TYPE' ) ) {
    switch ($env) {
        case PROD:
        case PREPROD:
        case DEV:
        case LOCAL:
            $type = CONST_DB_ORACLE;
            break;
        default:
            $type = CONST_DB_DEFAULT;
            break;
    }
    define( 'CONST_DB_TYPE', $type );
}

if ( !defined( 'CONST_DB_HOST' ) ) {
    switch ($env) {
        case PROD:
            $host = '10.115.100.192';
            break;
        case PREPROD:
        case DEV:
            $host = '10.115.100.26';
            break;
        case LOCAL:
            $host = '192.168.69.7';
            break;
        default:
            $host = '192.168.1.9';
            break;
    }
    define( 'CONST_DB_HOST', $host );
}
if ( !defined( 'CONST_DB_PORT' ) ) {
    switch ($env) {
        case PROD:
        case PREPROD:
        case LOCAL:
        case DEV:
            $port = 1521;
            break;
        default:
            $port = 3306;
            break;
    }
    define( 'CONST_DB_PORT', $port );
}
if ( !defined( 'CONST_DB_USER' ) ) {
    switch ($env) {
        case PROD:
        case PREPROD:
        case DEV:
            $user = 'JETPULP';
            break;
        case LOCAL:
            $user = 'cridon';
            break;
        default:
            $user = 'cridon';
            break;
    }
    define( 'CONST_DB_USER', $user );
}
if ( !defined( 'CONST_DB_PASSWORD' ) ) {
    switch ($env) {
        case PROD:
        case PREPROD:
        case DEV:
            $pwd = 'JTPLPX3';
            break;
        case LOCAL:
            $pwd = 'cridon';
            break;
        default:
            $pwd = '2d7nGNFc';
            break;
    }
    define( 'CONST_DB_PASSWORD', $pwd );
}
if ( !defined( 'CONST_DB_DATABASE' ) ) {
    switch ($env) {
        case PROD:
        case PREPROD:
        case DEV:
            $dbn = 'X150';
            break;
        case LOCAL:
            $dbn = 'XE';
            break;
        default:
            $dbn = 'cridon';
            break;
    }
    define( 'CONST_DB_DATABASE', $dbn );
}
if ( !defined( 'CONST_DB_TABLE_NOTAIRE' ) ) {
    switch ($env) {
        case PROD:
            $prefix = 'CLCRIDON.';
            break;
        case PREPROD:
        case DEV:
            $prefix = 'CLCRITST.';
            break;
        case LOCAL:
        default:
            $prefix = '';
            break;
    }
    define( 'CONST_DB_TABLE_NOTAIRE', $prefix.'ZEXPNOTV' );
}
if ( !defined( 'CONST_DB_TABLE_ABONNE' ) ) {
    switch ($env) {
        case PROD:
            $prefix = 'CLCRIDON.';
            break;
        case PREPROD:
        case DEV:
            $prefix = 'CLCRITST.';
            break;
        case LOCAL:
        default:
            $prefix = '';
            break;
    }
    define( 'CONST_DB_TABLE_ABONNE', $prefix.'YABONNE' );
}


// import CSV notaire file path
if ( !defined( 'CONST_IMPORT_CSV_NOTAIRE_FILE_PATH' ) ) {
//    define( 'CONST_IMPORT_CSV_NOTAIRE_FILE_PATH', 'G:/MyProjects/JetPulp/Docs/CSV/' );
    define( 'CONST_IMPORT_CSV_NOTAIRE_FILE_PATH', 'PATH_TO_CSVFILE' );
}

// status
if ( !defined( 'CONST_STATUS_ENABLED' ) ) {
    define( 'CONST_STATUS_ENABLED', 2 );
}
if ( !defined( 'CONST_STATUS_DISABLED' ) ) {
    define( 'CONST_STATUS_DISABLED', 1 );
}

// default role by notaire group
if ( !defined( 'CONST_OFFICES_ROLE' ) ) {
    define( 'CONST_OFFICES_ROLE', 'OFF' );
}
if ( !defined( 'CONST_ORGANISMES_ROLE' ) ) {
    define( 'CONST_ORGANISMES_ROLE', 'ORG' );
}
if ( !defined( 'CONST_CLIENTDIVERS_ROLE' ) ) {
    define( 'CONST_CLIENTDIVERS_ROLE', 'DIV' );
}

// import option to be used (csv, odbc, oci)
if ( !defined( 'CONST_IMPORT_OPTION' ) ) {
    switch ($env) {
        case PROD:
        case PREPROD:
        case DEV:
        case LOCAL:
            $dbn = 'oci';
            break;
        default:
            $dbn = 'odbc';
            break;
    }
    define( 'CONST_IMPORT_OPTION', $dbn );
}

// login
if ( !defined( 'CONST_LOGIN_ERROR_MSG' ) ) {
    define( 'CONST_LOGIN_ERROR_MSG', 'Les informations de connexion sont incorrectes. En cas d\'erreurs répétées, nous vous invitons à contacter le CRIDON LYON afin de recevoir vos identifiants' );
}
if ( !defined( 'CONST_LOGIN_EMPTY_ERROR_MSG' ) ) {
    define( 'CONST_LOGIN_EMPTY_ERROR_MSG', 'Merci de bien remplir votre identifiant et mot de passe !' );
}
if ( !defined( 'CONST_TPL_FORM_ID' ) ) {
    define( 'CONST_TPL_FORM_ID', 'loginFormId' );
}
if ( !defined( 'CONST_TPL_ERRORBLOCK_ID' ) ) {
    define( 'CONST_TPL_ERRORBLOCK_ID', 'errorMsgId' );
}
if ( !defined( 'CONST_TPL_LOGINFIELD_ID' ) ) {
    define( 'CONST_TPL_LOGINFIELD_ID', 'loginFieldId' );
}
if ( !defined( 'CONST_TPL_PASSWORDFIELD_ID' ) ) {
    define( 'CONST_TPL_PASSWORDFIELD_ID', 'passwordFieldId' );
}
//Default Post per page
if ( !defined( 'DEFAULT_POST_PER_PAGE' ) ) {
    define( 'DEFAULT_POST_PER_PAGE', 10 );
}

// lost password
if ( !defined( 'CONST_INVALIDEMAIL_ERROR_MSG' ) ) {
    define( 'CONST_INVALIDEMAIL_ERROR_MSG', 'Vous ne pouvez pas récupérer votre mot de passe. Merci de contacter CRIDON LYON' );
}
if ( !defined( 'CONST_RECOVPASS_SUCCESS_MSG' ) ) {
    define( 'CONST_RECOVPASS_SUCCESS_MSG', 'Votre mot de passe veint d\'être envoyé sur votre adresse email.' );
}
if ( !defined( 'CONST_TPL_PWDFORM_ID' ) ) {
    define( 'CONST_TPL_PWDFORM_ID', 'lostPwdFormId' );
}
if ( !defined( 'CONST_TPL_PWDMSGBLOCK_ID' ) ) {
    define( 'CONST_TPL_PWDMSGBLOCK_ID', 'msgBlockId' );
}
if ( !defined( 'CONST_CRPCEN_EMPTY_ERROR_MSG' ) ) {
    define( 'CONST_CRPCEN_EMPTY_ERROR_MSG', 'Merci de bien remplir vos adresse email et CRPCEN !' );
}
if ( !defined( 'CONST_TPL_PWDEMAILFIELD_ID' ) ) {
    define( 'CONST_TPL_PWDEMAILFIELD_ID', 'emailFieldId' );
}
if ( !defined( 'CONST_TPL_CRPCENFIELD_ID' ) ) {
    define( 'CONST_TPL_CRPCENFIELD_ID', 'crpcenFieldId' );
}
if ( !defined( 'CONST_EMAIL_SUBJECT' ) ) {
    define( 'CONST_EMAIL_SUBJECT', 'Cridon - Mot de passe oublié' );
}
// do not remove "%s" : it uses to inject password value into the mail content
if ( !defined( 'CONST_EMAIL_CONTENT' ) ) {
    define( 'CONST_EMAIL_CONTENT', 'Votre mot de passe pour accèder à l\'espace privé du site de CRIDON LYON est : %s' );
}

// email sender adress and name
// Hook wp_mail for not using sitename and "Wordpress" by default
if ( !defined( 'CONST_EMAIL_SENDER_NAME' ) ) {
    define( 'CONST_EMAIL_SENDER_NAME', 'Cridon' );
}
if ( !defined( 'CONST_EMAIL_SENDER_CONTACT' ) ) {
    define( 'CONST_EMAIL_SENDER_CONTACT', 'informations@cridon-lyon.fr' );
}

// import CSV solde file path
if ( !defined( 'CONST_IMPORT_CSV_SOLDE_FILE_PATH' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_IMPORT_CSV_SOLDE_FILE_PATH', $uploadDir['basedir'] . '/import/importConso/' );
}

// Contact email for import error reporting
if ( !defined( 'CONST_EMAIL_ERROR_CONTACT' ) ) {
    define( 'CONST_EMAIL_ERROR_CONTACT', 'victor.albert@jetpulp.fr' );
}

// do not remove "%s" : it uses to inject import type (notaire|solde) into the mail content
if ( !defined( 'CONST_EMAIL_ERROR_SUBJECT' ) ) {
    define( 'CONST_EMAIL_ERROR_SUBJECT', 'Cridon - Import' );
}
if ( !defined( 'CONST_EMAIL_ERROR_CONTENT' ) ) {
    define( 'CONST_EMAIL_ERROR_CONTENT', 'Fichier d\'import absent pour : %s' );
}
if ( !defined( 'CONST_EMAIL_ERROR_CORRUPTED_FILE' ) ) {
    define( 'CONST_EMAIL_ERROR_CORRUPTED_FILE', 'Fichier d\'import mal formaté pour : %s' );
}

// Error reporting for Exception
if ( !defined( 'CONST_EMAIL_ERROR_CATCH_EXCEPTION' ) ) {
    define( 'CONST_EMAIL_ERROR_CATCH_EXCEPTION', 'Une exception a été levée avec le message d\'erreur suivante : "%s"' );
}
// Appel && Courrier support id
if ( !defined( 'CONST_SUPPORT_APPEL_ID' ) ) {
    define( 'CONST_SUPPORT_APPEL_ID',  2);
}
if ( !defined( 'CONST_SUPPORT_COURRIER_ID' ) ) {
    define( 'CONST_SUPPORT_COURRIER_ID',  1);
}
if ( !defined( 'CONST_SUPPORT_URG48H_ID' ) ) {
    define( 'CONST_SUPPORT_URG48H_ID',  6);
}
if ( !defined( 'CONST_SUPPORT_URGWEEK_ID' ) ) {
    define( 'CONST_SUPPORT_URGWEEK_ID',  7);
}
if ( !defined( 'CONST_SUPPORT_NON_FACTURE' ) ) {
    define( 'CONST_SUPPORT_NON_FACTURE',  5);
}
if ( !defined( 'CONST_SUPPORT_MES_DIANE' ) ) {
    define( 'CONST_SUPPORT_MES_DIANE',  4);
}
if ( !defined( 'CONST_SUPPORT_3_TO_4_WEEKS_INITIALE_ID' ) ) {
    define( 'CONST_SUPPORT_3_TO_4_WEEKS_INITIALE_ID',  8);
}
if ( !defined( 'CONST_SUPPORT_2_DAYS_INITIALE_ID' ) ) {
    define( 'CONST_SUPPORT_2_DAYS_INITIALE_ID',  9);
}
if ( !defined( 'CONST_SUPPORT_5_DAYS_MEDIUM_ID' ) ) {
    define( 'CONST_SUPPORT_5_DAYS_MEDIUM_ID',  10);
}
if ( !defined( 'CONST_SUPPORT_RDV_TEL_MEDIUM_ID' ) ) {
    define( 'CONST_SUPPORT_RDV_TEL_MEDIUM_ID',  11);
}
if ( !defined( 'CONST_SUPPORT_3_TO_4_WEEKS_EXPERT_ID' ) ) {
    define( 'CONST_SUPPORT_3_TO_4_WEEKS_EXPERT_ID',  12);
}
if ( !defined( 'CONST_SUPPORT_DOSSIER_EXPERT_ID' ) ) {
    define( 'CONST_SUPPORT_DOSSIER_EXPERT_ID',  13);
}
if ( !defined( 'CONST_SUPPORT_LETTRE_HORS_DELAI_ID' ) ) {
    define( 'CONST_SUPPORT_LETTRE_HORS_DELAI_ID',  14);
}
if ( !defined( 'CONST_SUPPORT_2_DAYS_INITIALE_HORS_DELAI_ID' ) ) {
    define( 'CONST_SUPPORT_2_DAYS_INITIALE_HORS_DELAI_ID',  15);
}
if ( !defined( 'CONST_SUPPORT_5_DAYS_MEDIUM_HORS_DELAI_ID' ) ) {
    define( 'CONST_SUPPORT_5_DAYS_MEDIUM_HORS_DELAI_ID',  16);
}

// Notaire fonctions id (used for filtering capability)
if ( !defined( 'CONST_NOTAIRE_FONCTION' ) ) {
    define( 'CONST_NOTAIRE_FONCTION', 1 );
}
if ( !defined( 'CONST_NOTAIRE_ASSOCIE' ) ) {
    define( 'CONST_NOTAIRE_ASSOCIE', 2 );
}
if ( !defined( 'CONST_NOTAIRE_ASSOCIEE' ) ) {
    define( 'CONST_NOTAIRE_ASSOCIEE', 3 );
}
if ( !defined( 'CONST_NOTAIRE_SALARIE' ) ) {
    define( 'CONST_NOTAIRE_SALARIE', 4 );
}
if ( !defined( 'CONST_NOTAIRE_SALARIEE' ) ) {
    define( 'CONST_NOTAIRE_SALARIEE', 5 );
}
if ( !defined( 'CONST_NOTAIRE_GERANT' ) ) {
    define( 'CONST_NOTAIRE_GERANT', 6 );
}
if ( !defined( 'CONST_NOTAIRE_GERANTE' ) ) {
    define( 'CONST_NOTAIRE_GERANTE', 7 );
}
if ( !defined( 'CONST_NOTAIRE_SUPLEANT' ) ) {
    define( 'CONST_NOTAIRE_SUPLEANT', 8 );
}
if ( !defined( 'CONST_NOTAIRE_SUPLEANTE' ) ) {
    define( 'CONST_NOTAIRE_SUPLEANTE', 9 );
}
if ( !defined( 'CONST_NOTAIRE_ADMIN' ) ) {
    define( 'CONST_NOTAIRE_ADMIN', 10 );
}
if ( !defined( 'CONST_NOTAIRE_PRESIDENT_CHAMBRE' ) ) {
    define( 'CONST_NOTAIRE_PRESIDENT_CHAMBRE', 11 );
}
if ( !defined( 'CONST_NOTAIRE_PRESIDENT_CONSEIL' ) ) {
    define( 'CONST_NOTAIRE_PRESIDENT_CONSEIL', 12 );
}
if ( !defined( 'CONST_NOTAIRE_DELEGUE_CRIDON' ) ) {
    define( 'CONST_NOTAIRE_DELEGUE_CRIDON', 13 );
}
if ( !defined( 'CONST_NOTAIRE_DIRECTEUR' ) ) {
    define( 'CONST_NOTAIRE_DIRECTEUR', 14 );
}
if ( !defined( 'CONST_NOTAIRE_DIRECTEUR_GENERAL' ) ) {
    define( 'CONST_NOTAIRE_DIRECTEUR_GENERAL', 15 );
}
if ( !defined( 'CONST_NOTAIRE_DIRECTEUR_DEPARTEMET' ) ) {
    define( 'CONST_NOTAIRE_DIRECTEUR_DEPARTEMET', 16 );
}
if ( !defined( 'CONST_NOTAIRE_CONSEIL_JUR' ) ) {
    define( 'CONST_NOTAIRE_CONSEIL_JUR', 17 );
}
if ( !defined( 'CONST_NOTAIRE_ASSISTANT' ) ) {
    define( 'CONST_NOTAIRE_ASSISTANT', 18 );
}
if ( !defined( 'CONST_NOTAIRE_ASSISTANTE' ) ) {
    define( 'CONST_NOTAIRE_ASSISTANTE', 19 );
}
if ( !defined( 'CONST_NOTAIRE_HONORAIRE' ) ) {
    define( 'CONST_NOTAIRE_HONORAIRE', 20 );
}
if ( !defined( 'CONST_NOTAIRE_SG' ) ) {
    define( 'CONST_NOTAIRE_SG', 21 );
}
if ( !defined( 'CONST_NOTAIRE_SECRETAIRE' ) ) {
    define( 'CONST_NOTAIRE_SECRETAIRE', 22 );
}
if ( !defined( 'CONST_NOTAIRE_SECOND_RAPORTEUR' ) ) {
    define( 'CONST_NOTAIRE_SECOND_RAPORTEUR', 23 );
}
if ( !defined( 'CONST_NOTAIRE_PROF_DROIT' ) ) {
    define( 'CONST_NOTAIRE_PROF_DROIT', 24 );
}
if ( !defined( 'CONST_NOTAIRE_TRESORIER' ) ) {
    define( 'CONST_NOTAIRE_TRESORIER', 25 );
}
if ( !defined( 'CONST_NOTAIRE_CHARGE_DVP' ) ) {
    define( 'CONST_NOTAIRE_CHARGE_DVP', 26 );
}
// id of collaborator on cri_fonction
if ( !defined( 'CONST_NOTAIRE_COLLABORATEUR' ) ) {
    define( 'CONST_NOTAIRE_COLLABORATEUR', 27 );
}
if ( !defined( 'CONST_NOTAIRE_GEOMETRE' ) ) {
    define( 'CONST_NOTAIRE_GEOMETRE', 28 );
}

// Notary Collaborator functions id
if ( !defined( 'CONST_COLLAB_COMPTABLE' ) ) {
    define( 'CONST_COLLAB_COMPTABLE', 1 );
}
if ( !defined( 'CONST_COLLAB_COMPTABLE_TAXATEUR' ) ) {
    define( 'CONST_COLLAB_COMPTABLE_TAXATEUR', 2 );
}
if ( !defined( 'CONST_COLLAB_CLERC' ) ) {
    define( 'CONST_COLLAB_CLERC', 3 );
}
if ( !defined( 'CONST_COLLAB_NEGOCIATEUR' ) ) {
    define( 'CONST_COLLAB_NEGOCIATEUR', 4 );
}
if ( !defined( 'CONST_COLLAB_ASSISTANT' ) ) {
    define( 'CONST_COLLAB_ASSISTANT', 5 );
}
if ( !defined( 'CONST_COLLAB_STAGIAIRE' ) ) {
    define( 'CONST_COLLAB_STAGIAIRE', 6 );
}
if ( !defined( 'CONST_COLLAB_EMPLOYE_ACCUEIL' ) ) {
    define( 'CONST_COLLAB_EMPLOYE_ACCUEIL', 7 );
}
if ( !defined( 'CONST_COLLAB_SECRETAIRE' ) ) {
    define( 'CONST_COLLAB_SECRETAIRE', 8 );
}
if ( !defined( 'CONST_COLLAB_CADRE' ) ) {
    define( 'CONST_COLLAB_CADRE', 9 );
}
if ( !defined( 'CONST_COLLAB_SECRETAIRE_ASSIST' ) ) {
    define( 'CONST_COLLAB_SECRETAIRE_ASSIST', 10 );
}
if ( !defined( 'CONST_COLLAB_TECHNICIEN' ) ) {
    define( 'CONST_COLLAB_TECHNICIEN', 11 );
}
if ( !defined( 'CONST_QUESTION_EXPERTISE_DOCUMENTATION_ID' ) ) {
    define( 'CONST_QUESTION_EXPERTISE_DOCUMENTATION_ID', 1 );
}
if ( !defined( 'CONST_QUESTION_SUPPORT_DOCUMENTATION_ID' ) ) {
    define( 'CONST_QUESTION_SUPPORT_DOCUMENTATION_ID', 8 );
}


// Add Question Form
if ( !defined( 'CONST_QUESTION_MATIERE_DOCUMENTATION_ID' ) ) {
    define('CONST_QUESTION_MATIERE_DOCUMENTATION_ID', 9);
}
if ( !defined( 'CONST_QUESTION_SUPPORT_FIELD' ) ) {
    define( 'CONST_QUESTION_SUPPORT_FIELD', 'question_support' );
}
if ( !defined( 'CONST_QUESTION_FORM_ID' ) ) {
    define( 'CONST_QUESTION_FORM_ID', 'questionFormId' );
}
if ( !defined( 'CONST_QUESTION_MATIERE_FIELD' ) ) {
    define( 'CONST_QUESTION_MATIERE_FIELD', 'question_matiere' );
}
if ( !defined( 'CONST_QUESTION_COMPETENCE_FIELD' ) ) {
    define( 'CONST_QUESTION_COMPETENCE_FIELD', 'question_competence' );
}
if ( !defined( 'CONST_QUESTION_OBJECT_FIELD' ) ) {
    define( 'CONST_QUESTION_OBJECT_FIELD', 'question_objet' );
}
if ( !defined( 'CONST_QUESTION_MESSAGE_FIELD' ) ) {
    define( 'CONST_QUESTION_MESSAGE_FIELD', 'question_message' );
}
if ( !defined( 'CONST_QUESTION_ATTACHEMENT_FIELD' ) ) {
    define( 'CONST_QUESTION_ATTACHEMENT_FIELD', 'question_fichier' );
}
// Files options
if ( !defined( 'CONST_QUESTION_MAX_FILE_SIZE' ) ) {
    define( 'CONST_QUESTION_MAX_FILE_SIZE', 10000000 ); // bytes
}
// Success Message
if ( !defined( 'CONST_QUESTION_SUCCESS_MSG_FIELD' ) ) {
    define( 'CONST_QUESTION_SUCCESS_MSG_FIELD', 'msgBlockQuestionId' );
}
if ( !defined( 'CONST_QUESTION_ACTION_SUCCESSFUL' ) ) {
    define( 'CONST_QUESTION_ACTION_SUCCESSFUL', 'Question envoyée avec succès' );
}
// Error message
if ( !defined( 'CONST_QUESTION_ACTION_ERROR' ) ) {
    define( 'CONST_QUESTION_ACTION_ERROR', 'Une erreur s\'est produite lors de l\'envoie de votre question. Merci de contacter le responsable.' );
}
if ( !defined( 'CONST_QUESTION_MAX_FILES_ERROR' ) ) {
    define( 'CONST_QUESTION_MAX_FILES_ERROR', 'Le nombre maximal de fichiers autorisés est de %s' );
}
if ( !defined( 'CONST_QUESTION_FILE_SIZE_ERROR' ) ) {
    define( 'CONST_QUESTION_FILE_SIZE_ERROR', 'La taille maximale du fichier ne doit pas dépasser %s' );
}//Default question answered per page
if ( !defined( 'DEFAULT_QUESTION_PER_PAGE' ) ) {
    define( 'DEFAULT_QUESTION_PER_PAGE', 10 );
}


// import Question
if ( !defined( 'CONST_ODBC_TABLE_QUEST' ) ) {
    switch ($env) {
        case PROD:
            $prefix = 'CLCRIDON.';
            break;
        case PREPROD:
        case DEV:
            $prefix = 'CLCRITST.';
            break;
        case LOCAL:
        default:
            $prefix = '';
            break;
    }
    define( 'CONST_ODBC_TABLE_QUEST', $prefix.'ZQUESTV' );
}
if ( !defined( 'CONST_QUEST_CREATED_BY_SITE' ) ) {
    define( 'CONST_QUEST_CREATED_BY_SITE', 0 );
}
if ( !defined( 'CONST_QUEST_CREATED_IN_X3' ) ) {
    define( 'CONST_QUEST_CREATED_IN_X3', 1 );
}
if ( !defined( 'CONST_QUEST_UPDATED_IN_X3' ) ) {
    define( 'CONST_QUEST_UPDATED_IN_X3', 2 );
}
if ( !defined( 'CONST_QUEST_TRANSMIS_ERP' ) ) {
    define( 'CONST_QUEST_TRANSMIS_ERP', 1 );
}
if ( !defined( 'CONST_QUEST_ANSWERED' ) ) {
    define( 'CONST_QUEST_ANSWERED', 4 );
}
//Flag question en erreur
if ( !defined( 'CONST_QUEST_SANS_ERREUR' ) ) {
    define( 'CONST_QUEST_SANS_ERREUR', 0 );
}
if ( !defined( 'CONST_QUEST_EN_ERREUR' ) ) {
    define( 'CONST_QUEST_EN_ERREUR', 1 );
}
if ( !defined( 'CONST_QUEST_EN_ERREUR_GRAVE' ) ) {
    define( 'CONST_QUEST_EN_ERREUR_GRAVE', 2 );
}
// import GED
if ( !defined( 'CONST_IMPORT_DOCUMENT_ORIGINAL_PATH' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_IMPORT_DOCUMENT_ORIGINAL_PATH', $uploadDir['basedir'] . '/import/importsGED/' );
}
if ( !defined( 'CONST_IMPORT_DOCUMENT_TEMP_PATH' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_IMPORT_DOCUMENT_TEMP_PATH', $uploadDir['basedir'] . '/import/importsGEDTemp/' );
}
if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_CGUV_URL' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_CGUV_URL', $uploadDir['basedir'] . '/documentsCridon/CGUV.pdf' );
}
if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_CGUV_PATH' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_CGUV_PATH', $uploadDir['baseurl'] . '/documentsCridon/CGUV.pdf' );
}
if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_MANDAT_SEPA_B2B_URL' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_MANDAT_SEPA_B2B_URL', $uploadDir['basedir'] . '/documentsCridon/Mandat_SEPA_B2B.pdf' );
}
if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_MANDAT_SEPA_B2B_PATH' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_MANDAT_SEPA_B2B_PATH', $uploadDir['baseurl'] . '/documentsCridon/Mandat_SEPA_B2B.pdf' );
}
if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_MANDAT_SEPA_B2C_URL' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_MANDAT_SEPA_B2C_URL', $uploadDir['basedir'] . '/documentsCridon/Mandat_SEPA_B2C.pdf' );
}
if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_MANDAT_SEPA_B2C_PATH' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_MANDAT_SEPA_B2C_PATH', $uploadDir['baseurl'] . '/documentsCridon/Mandat_SEPA_B2C.pdf' );
}


if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_REFERENCE' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_REFERENCE', $uploadDir['baseurl'] . '/documentsCridon/Description-CRIDONLINE-reference.pdf' );
}
if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_REFERENCE_PROMO' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_REFERENCE_PROMO', $uploadDir['baseurl'] . '/documentsCridon/Description-CRIDONLINE-reference-promo.pdf' );
}


if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_PREMIUM' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_PREMIUM', $uploadDir['baseurl'] . '/documentsCridon/Description-CRIDONLINE-premium.pdf' );
}
if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_PREMIUM_PROMO' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_PREMIUM_PROMO', $uploadDir['baseurl'] . '/documentsCridon/Description-CRIDONLINE-premium-promo.pdf' );
}


if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_EXCELLENCE' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_EXCELLENCE', $uploadDir['baseurl'] . '/documentsCridon/Description-CRIDONLINE-excellence.pdf' );
}
if ( !defined( 'CONST_CRIDONLINE_DOCUMENT_EXCELLENCE_PROMO' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_CRIDONLINE_DOCUMENT_EXCELLENCE_PROMO', $uploadDir['baseurl'] . '/documentsCridon/Description-CRIDONLINE-excellence-promo.pdf' );
}

if ( !defined( 'CONST_IMPORT_FILE_TYPE' ) ) {
    define( 'CONST_IMPORT_FILE_TYPE', 'txt' );
}
if ( !defined( 'CONST_IMPORT_GED_CONTENT_SEPARATOR' ) ) {
    define( 'CONST_IMPORT_GED_CONTENT_SEPARATOR', ';' );
}
if ( !defined( 'CONST_IMPORT_GED_LOG_SUCCESS_MSG' ) ) {
    define( 'CONST_IMPORT_GED_LOG_SUCCESS_MSG', 'Import GED du %s : action terminée avec succès pour les documents suivants "%s"' );
}
if ( !defined( 'CONST_IMPORT_GED_LOG_CORRUPTED_DOC_MSG' ) ) {
    define( 'CONST_IMPORT_GED_LOG_CORRUPTED_DOC_MSG', 'Import GED du %s : le CSV associé au document "%s" ne contenait pas les informations attendues' );
}
if ( !defined( 'CONST_IMPORT_GED_LOG_CORRUPTED_CSV_MSG' ) ) {
    define( 'CONST_IMPORT_GED_LOG_CORRUPTED_CSV_MSG', 'Import GED du %s : fichier d\'import mal formaté pour "%s"' );
}
if ( !defined( 'CONST_IMPORT_GED_LOG_CORRUPTED_PDF_MSG' ) ) {
    define( 'CONST_IMPORT_GED_LOG_CORRUPTED_PDF_MSG', 'Import GED du %s : le fichier PDF associé au CSV de la question "%s" est illisible' );
}
if ( !defined( 'CONST_IMPORT_GED_LOG_EMPTY_DIR_MSG' ) ) {
    define( 'CONST_IMPORT_GED_LOG_EMPTY_DIR_MSG', 'Import GED du %s : Aucun document traité' );
}
if ( !defined( 'CONST_IMPORT_GED_LOG_DOC_WITHOUT_QUESTION_MSG' ) ) {
    define( 'CONST_IMPORT_GED_LOG_DOC_WITHOUT_QUESTION_MSG', 'Import GED du %s : aucune question n\'est associée au document suivant "%s"' );
}
if ( !defined( 'CONST_IMPORT_GED_GENERIC_ERROR_MSG' ) ) {
    define( 'CONST_IMPORT_GED_GENERIC_ERROR_MSG', 'Erreur survenue lors de l\'import de la GED' );
}
// Cridonline const
if ( !defined( 'CONST_CRIDONLINE_A_TRANSMETTRE_ERP' ) ) {
    define( 'CONST_CRIDONLINE_A_TRANSMETTRE_ERP', 1 );
}
if ( !defined( 'CONST_CRIDONLINE_ECHEANCE_A_TRANSMETTRE_ERP' ) ) {
    define( 'CONST_CRIDONLINE_ECHEANCE_A_TRANSMETTRE_ERP', 0 );
}
if ( !defined( 'CONST_LOWEST_PAID_LEVEL_CRIDONLINE' ) ) {
    define( 'CONST_LOWEST_PAID_LEVEL_CRIDONLINE', 2 );
}
if ( !defined( 'CONST_CRIDONLINE_SUBSCRIPTION_DURATION_DAYS' ) ) {
    define( 'CONST_CRIDONLINE_SUBSCRIPTION_DURATION_DAYS', 365 );
}
if ( !defined( 'CONST_CRIDONLINE_ECHEANCE_MONTH' ) ) {
    define( 'CONST_CRIDONLINE_ECHEANCE_MONTH', 2 );
}
if ( !defined( 'CONST_EXPORT_CRIDONLINE_ERROR' ) ) {
    define( 'CONST_EXPORT_CRIDONLINE_ERROR', 'Export cridonline interrompu le : %s' );
}
if ( !defined( 'CONST_ERROR_MSG_NIV_VEILLE_INSUFFISANT' ) ) {
    define( 'CONST_ERROR_MSG_NIV_VEILLE_INSUFFISANT', "Votre étude n'a pas souscrit à ce niveau d'offre CRID'ONLINE." );
}
if ( !defined( 'CONST_ERROR_MSG_FONCTION_NON_AUTORISE' ) ) {
    define( 'CONST_ERROR_MSG_FONCTION_NON_AUTORISE', "Vous n'avez pas l'autorisation pour accéder à cette page." );
}

if (!defined('CONST_CONNECTION_FAILED')) {
    define('CONST_CONNECTION_FAILED', 'La connexion à la base Oracle a échoué');
}

// Log file
if ( !defined( 'CONST_LOG_ERROR_DIR' ) ) {
    $logDir = WP_PLUGIN_DIR . '/cridon/logs';
    if (!is_dir($logDir)) {
        wp_mkdir_p($logDir);
    }
    define( 'CONST_LOG_ERROR_DIR',  $logDir);
}

// newsletter form
if ( !defined( 'CONST_NEWSLETTER_EMAIL_ERROR_MSG' ) ) {
    define( 'CONST_NEWSLETTER_EMAIL_ERROR_MSG', 'Malheureusement vous ne disposez pas d\'adresse mail personnelle à laquelle envoyer la newsletter : veuillez contacter le Cridon pour l\'ajouter à vos informations personnes' );
}
if ( !defined( 'CONST_NEWSLETTER_EMPTY_ERROR_MSG' ) ) {
    define( 'CONST_NEWSLETTER_EMPTY_ERROR_MSG', 'Merci de bien remplir votre adresse email!' );
}
if ( !defined( 'CONST_NEWSLETTER_SUCCESS_MSG' ) ) {
    define( 'CONST_NEWSLETTER_SUCCESS_MSG', 'Inscription terminée avec succès.' );
}
if ( !defined( 'CONST_NEWSLETTER_FORM_ID' ) ) {
    define( 'CONST_NEWSLETTER_FORM_ID', 'newsletterFormId' );
}
if ( !defined( 'CONST_NEWSLETTER_EMAIL_FIELD' ) ) {
    define( 'CONST_NEWSLETTER_EMAIL_FIELD', 'userEmail' );
}
if ( !defined( 'CONST_NEWSLETTER_MSGBLOCK_ID' ) ) {
    define( 'CONST_NEWSLETTER_MSGBLOCK_ID', 'newsletterMsgId' );
}
if ( !defined( 'CONST_CRIDONLINE_CGV_ERROR_MSG' ) ) {
    define( 'CONST_CRIDONLINE_CGV_ERROR_MSG', 'Vous devez accepter les conditions générales d\'utilisations pour souscrire à l\'offre CRID\'ONLINE' );
}
if ( !defined( 'CONST_CRIDONLINE_LABEL_LEVEL_2' ) ) {
    define( 'CONST_CRIDONLINE_LABEL_LEVEL_2', 'Premium' );
}
if ( !defined( 'CONST_CRIDONLINE_LABEL_LEVEL_3' ) ) {
    define( 'CONST_CRIDONLINE_LABEL_LEVEL_3', 'Excellence' );
}
if ( !defined( 'CONST_CRIDONLINE_LEVEL_2' ) ) {
    define( 'CONST_CRIDONLINE_LEVEL_2', 2 );
}
if ( !defined( 'CONST_CRIDONLINE_LEVEL_3' ) ) {
    define( 'CONST_CRIDONLINE_LEVEL_3', 3 );
}
// Collaborateur form
if ( !defined( 'CONST_COLLABORATEUR_DELETE_SUCCESS_MSG' ) ) {
    define( 'CONST_COLLABORATEUR_DELETE_SUCCESS_MSG', 'Le profil du collaborateur a bien été supprimé.' );
}
if ( !defined( 'CONST_COLLABORATEUR_DELETE_FAIL_MSG' ) ) {
    define( 'CONST_COLLABORATEUR_DELETE_ERROR_MSG', 'Un échec est survenu, merci de réésayer ultérieurement.' );
}
if ( !defined( 'CONST_COLLABORATEUR_ADD_SUCCESS_MSG' ) ) {
    define( 'CONST_COLLABORATEUR_ADD_SUCCESS_MSG', 'Le collaborateur a bien été ajouté à votre étude.' );
}
if ( !defined( 'CONST_COLLABORATEUR_ADD_ERROR_MSG' ) ) {
    define( 'CONST_COLLABORATEUR_ADD_ERROR_MSG', 'Un échec est survenu, merci de réésayer ultérieurement.' );
}
if ( !defined( 'CONST_COLLABORATEUR_MODIFY_ERROR_MSG' ) ) {
    define( 'CONST_COLLABORATEUR_MODIFY_ERROR_MSG', 'Un échec est survenu, merci de réésayer ultérieurement.' );
}
if ( !defined( 'CONST_COLLABORATEUR_FUNCTION_ERROR_MSG' ) ) {
    define( 'CONST_COLLABORATEUR_FUNCTION_ERROR_MSG', 'Merci de remplir la fonction collaborateur.' );
}
if ( !defined( 'CONST_COLLABORATEUR_MODIFY_SUCCESS_MSG' ) ) {
    define( 'CONST_COLLABORATEUR_MODIFY_SUCCESS_MSG', 'Le collaborateur a bien été modifié.' );
}
if ( !defined( 'CONST_PROFIL_MODIFY_SUCCESS_MSG' ) ) {
    define( 'CONST_PROFIL_MODIFY_SUCCESS_MSG', 'Votre profil a bien été modifié.' );
}
if ( !defined( 'CONST_PROFIL_OFFICE_MODIFY_ERROR_MSG' ) ) {
    define( 'CONST_PROFIL_OFFICE_MODIFY_ERROR_MSG', 'Un échec est survenu, merci de réésayer ultérieurement.' );
}
if ( !defined( 'CONST_PROFIL_OFFICE_MODIFY_SUCCESS_MSG' ) ) {
    define( 'CONST_PROFIL_OFFICE_MODIFY_SUCCESS_MSG', 'Les données de votre étude ont bien été modifiées.' );
}
if ( !defined( 'CONST_PROFIL_PASSWORD_ERROR_MSG' ) ) {
    define( 'CONST_PROFIL_PASSWORD_ERROR_MSG', 'Un échec est survenu, merci de réésayer ultérieurement.' );
}
if ( !defined( 'CONST_PROFIL_PASSWORD_DIFFERENT_EMAIL_ERROR_MSG' ) ) {
    define( 'CONST_PROFIL_PASSWORD_DIFFERENT_EMAIL_ERROR_MSG', 'Les adresses emails entrées ne sont pas identiques.' );
}
if ( !defined( 'CONST_PROFIL_PASSWORD_MISSING_EMAIL_ERROR_MSG' ) ) {
    define( 'CONST_PROFIL_PASSWORD_MISSING_EMAIL_ERROR_MSG', 'Merci d\'ajouter une adresse email à votre profil afin de pouvoir modifier votre mot de passe.' );
}
if ( !defined( 'CONST_PROFIL_PASSWORD_DIFFERENT_PROFIL_EMAIL_ERROR_MSG' ) ) {
    define( 'CONST_PROFIL_PASSWORD_DIFFERENT_PROFIL_EMAIL_ERROR_MSG', 'L\'adresse email de votre profil ne correspond pas aux adresses entrées ci-dessus.' );
}
if ( !defined( 'CONST_PROFIL_PASSWORD_SUCCESS_MSG' ) ) {
    define( 'CONST_PROFIL_PASSWORD_SUCCESS_MSG', 'La demande de modification de mot de passe a bien été prise en compte.' );
}
if ( !defined( 'CONST_CREATE_USER' ) ) {
    define( 'CONST_CREATE_USER', 'create_user' );
}
if ( !defined( 'CONST_MODIFY_USER' ) ) {
    define( 'CONST_MODIFY_USER', 'modify_user' );
}
if ( !defined( 'CONST_PROFIL_MODIFY_USER' ) ) {
    define( 'CONST_PROFIL_MODIFY_USER', 'profil_modify_user' );
}
if ( !defined( 'CONST_DELETE_USER' ) ) {
    define( 'CONST_DELETE_USER', 'delete_user' );
}

//Alert on issues without documents
if ( !defined( 'CONST_ALERT_MINUTE' ) ) {
    define( 'CONST_ALERT_MINUTE', 30 );
}

// log import notaire start and end of action
if ( !defined( 'CONST_TRACE_IMPORT_NOTAIRE' ) ) {
    define( 'CONST_TRACE_IMPORT_NOTAIRE', 1 );
}

// import cahier
if ( !defined( 'CONST_IMPORT_CAHIER_PATH' ) ) {
    $uploadDir = wp_upload_dir();
    define( 'CONST_IMPORT_CAHIER_PATH', $uploadDir['basedir'] . '/import/importsCahier/' );
}

// question message d'erreur
if ( !defined( 'CONST_EMPTY_OBJECT_ERROR_MSG' ) ) {
    define( 'CONST_EMPTY_OBJECT_ERROR_MSG', 'Veuillez renseigner l\'objet de votre question' );
}
if ( !defined( 'CONST_EMPTY_MESSAGE_ERROR_MSG' ) ) {
    define( 'CONST_EMPTY_MESSAGE_ERROR_MSG', 'Veuillez renseigner une question' );
}
if ( !defined( 'CONST_EMPTY_SUPPORT_ERROR_MSG' ) ) {
    define( 'CONST_EMPTY_SUPPORT_ERROR_MSG', 'Veuillez renseigner votre type de consultation' );
}
if ( !defined( 'CONST_EMPTY_MATIERE_ERROR_MSG' ) ) {
    define( 'CONST_EMPTY_MATIERE_ERROR_MSG', 'Veuillez renseigner le champ Matiere' );
}
if ( !defined( 'CONST_EMPTY_COMPETENCE_ERROR_MSG' ) ) {
    define( 'CONST_EMPTY_COMPETENCE_ERROR_MSG', 'Veuillez renseigner le champ Competence' );
}
if ( !defined( 'CONST_MAXFILESIZE_ERROR_MSG' ) ) {
    define( 'CONST_MAXFILESIZE_ERROR_MSG', 'Taille de ' );
}

if ( !defined( 'CONST_MAX_SQL_OPERATION' ) ) {
    define( 'CONST_MAX_SQL_OPERATION', 10000 );
}

// import status code
if ( !defined( 'CONST_STATUS_CODE_OK' ) ) {
    define( 'CONST_STATUS_CODE_OK', 200 );
}
if ( !defined( 'CONST_STATUS_CODE_GONE' ) ) {
    define( 'CONST_STATUS_CODE_GONE', 410 );
}
// Export Question
if ( !defined( 'CONST_DB_TABLE_QUESTTEMP' ) ) {
    switch ($env) {
        case PROD:
            $prefix = 'CLCRIDON.';
            break;
        case PREPROD:
        case DEV:
            $prefix = 'CLCRITST.';
            break;
        case LOCAL:
        default:
            $prefix = '';
            break;
    }
    define( 'CONST_DB_TABLE_QUESTTEMP', $prefix.'ZQUEST' );
}
if ( !defined( 'CONST_EXPORT_EMAIL_ERROR' ) ) {
    define( 'CONST_EXPORT_EMAIL_ERROR', 'Export question interrompu le : %s' );
}

if ( !defined( 'CONST_WS_MSG_SUCCESS' ) ) {
    define( 'CONST_WS_MSG_SUCCESS',  'Connexion réussie');
}

if ( !defined( 'CONST_WS_MSG_ERROR_METHOD' ) ) {
    define( 'CONST_WS_MSG_ERROR_METHOD',  'Action non autorisée');
}
if ( !defined( 'CONST_WS_LOGIN_ROLE_ERROR_MSG' ) ) {
    define( 'CONST_WS_LOGIN_ROLE_ERROR_MSG',  'Vous ne possédez pas les droits pour accéder à cette application.');
}

// admin nb items per page
if ( !defined( 'CONST_ADMIN_NB_ITEM_PERPAGE' ) ) {
    define( 'CONST_ADMIN_NB_ITEM_PERPAGE', 20 );
}

// default notaire 2006_2009 password
if ( !defined( 'CONST_NOTARY_PWD' ) ) {
    define( 'CONST_NOTARY_PWD', 'cridon-jetpulp-2016' );
}

// admin nb formations per page
if ( !defined( 'CONST_ADMIN_NB_FORMATIONS_PERPAGE' ) ) {
    define( 'CONST_ADMIN_NB_FORMATIONS_PERPAGE', 10 );
}

// admins Cridon role
if ( !defined( 'CONST_ADMINCRIDON_ROLE' ) ) {
    define( 'CONST_ADMINCRIDON_ROLE', 'admincridon' );
}

// Start of Block for mobile
// token name var used in WS
if ( !defined( 'CONST_TOKEN_NAME_VAR' ) ) {
    define( 'CONST_TOKEN_NAME_VAR', 'token' );
}
if ( !defined( 'CONST_QUESTION_PUSHTOKEN_FIELD' ) ) {
    define( 'CONST_QUESTION_PUSHTOKEN_FIELD', 'pushToken' );
}
if ( !defined( 'CONST_QUESTION_DEVICETYPE_FIELD' ) ) {
    define( 'CONST_QUESTION_DEVICETYPE_FIELD', 'deviceType' );
}

// Activity & Sub domain activity error message
if ( !defined( 'CONST_EMPTY_ACTIVITY_ERROR_MSG' ) ) {
    define( 'CONST_EMPTY_ACTIVITY_ERROR_MSG', 'Veuillez renseigner votre domaine d\'activité.' );
}
if ( !defined( 'CONST_EMPTY_SUBACTIVITY_ERROR_MSG' ) ) {
    define( 'CONST_EMPTY_SUBACTIVITY_ERROR_MSG', 'Veuillez renseigner votre sous-domaine d\'activité.' );
}

// Push Notification
if ( !defined( 'CONST_GOOGLE_API_KEY' ) ) {
    switch ($env) {
        case PROD:
            $key =  'AIzaSyBh_fFDWcD41pxxbA4pHnYliP48K6BkBYw';
            break;
        case PREPROD:
        case DEV:
            $key = '';
            break;
        case LOCAL:
        default:
            $key = '';
            break;
    }
    define( 'CONST_GOOGLE_API_KEY', $key );
}
if ( !defined( 'CONST_GOOGLE_GCM_URL' ) ) {
    // alternative fournit par d'autre documentation : https://gcm-http.googleapis.com/gcm/send
    define( 'CONST_GOOGLE_GCM_URL', 'https://android.googleapis.com/gcm/send' );
}
if ( !defined( 'CONST_NOTIFICATION_ERROR' ) ) {
    define( 'CONST_NOTIFICATION_ERROR', 'Une erreur a été capturée avec le message suivant : "%s"' );
}
if ( !defined( 'CONST_ANDROID_TITLE_MSG' ) ) {
    define( 'CONST_ANDROID_TITLE_MSG', 'Notification Question traitée' );
}
if ( !defined( 'CONST_ANDROID_SUBTITLE_MSG' ) ) {
    define( 'CONST_ANDROID_SUBTITLE_MSG', 'Cridon Lyon' );
}
if ( !defined( 'CONST_NOTIFICATION_CONTENT_MSG' ) ) {
    define( 'CONST_NOTIFICATION_CONTENT_MSG', 'Votre question ayant comme objet "%s" a été bien traitée.' );
}
// APNS passphrase ( obtenu lors de la generation du Certificat )
if ( !defined( 'CONST_APNS_PASSPHRASE' ) ) {
    switch ($env) {
        case PROD:
            $pass =  'mahery';
            break;
        case PREPROD:
            $pass = '';
            break;
        case DEV:
        case LOCAL:
        default:
            $pass = '';
            break;
    }
    define( 'CONST_APNS_PASSPHRASE', $pass );
}
// APNS port
if ( !defined( 'CONST_APNS_PORT' ) ) {
    define( 'CONST_APNS_PORT', 2195 );
}
if ( !defined( 'CONST_APNS_PEM' ) ) {
    switch ($env) {
        case PROD:
            // APNS Prod certificat path ( fichier à generer )
            $pem =  WP_PLUGIN_DIR . '/cridon/app/apns/ckprod.pem';
            break;
        case PREPROD:
            // APNS Sandbox certificat path ( fichier à generer et emplacement à definir ici )
            $pem = WP_PLUGIN_DIR . '/cridon/app/apns/ck.pem';
            break;
        case DEV:
        case LOCAL:
        default:
            $pem = '';
            break;
    }
    define( 'CONST_APNS_PEM', $pem );
}

if ( !defined( 'CONST_APNS_URL' ) ) {
    switch ($env) {
        case PROD:
            // APNS Prod URL
            $apns_url = 'gateway.push.apple.com';
            break;
        case PREPROD:
            // APNS Sandbox URL
            $apns_url = 'gateway.sandbox.push.apple.com';
            break;
        case DEV:
        case LOCAL:
        default:
            $apns_url = '';
            break;
    }
    define( 'CONST_APNS_URL', $apns_url );
}

// End of block for mobile

// Reset pwd value to be inserted in YNOTAIRE
if ( !defined( 'CONST_YTRAITEE_RESETPWD' ) ) {
    define( 'CONST_YTRAITEE_RESETPWD', 3 );
}
if ( !defined( 'CONST_RESETPWD_ERROR' ) ) {
    define( 'CONST_RESETPWD_ERROR', 'Renouvellement mot de passe interrompu le : %s' );
}
if ( !defined( 'CONST_YDDEMDPTEL_RESETPWD_ON' ) ) {
    define( 'CONST_YDDEMDPTEL_RESETPWD_ON', 2 );
}
if ( !defined( 'CONST_YDDEMDPWEB_RESETPWD_ON' ) ) {
    define( 'CONST_YDDEMDPWEB_RESETPWD_ON', 2 );
}
if ( !defined( 'CONST_YDDEMDPTEL_RESETPWD_OFF' ) ) {
    define( 'CONST_YDDEMDPTEL_RESETPWD_OFF', 1 );
}
if ( !defined( 'CONST_YDDEMDPWEB_RESETPWD_OFF' ) ) {
    define( 'CONST_YDDEMDPWEB_RESETPWD_OFF', 1 );
}

if ( !defined( 'CONST_FACTURATION_PAGE_ID' ) ) {
    define( 'CONST_FACTURATION_PAGE_ID', 1515 );
}

// alert email changed
if ( !defined( 'CONST_ALERT_EMAIL_CHANGED' ) ) {
    define('CONST_ALERT_EMAIL_CHANGED', 'Attention : il s\'agit de votre adresse email personnelle');
}
// End of block delete collaborator

// ERP YNOTAIRE table
if ( !defined( 'CONST_DB_TABLE_YNOTAIRE' ) ) {
    switch ($env) {
        case PROD:
            $prefix = 'CLCRIDON.';
            break;
        case PREPROD:
        case DEV:
            $prefix = 'CLCRITST.';
            break;
        case LOCAL:
        default:
            $prefix = '';
            break;
    }
    define( 'CONST_DB_TABLE_YNOTAIRE', $prefix.'YNOTAIRE' );
}

// Onglet
if ( !defined( 'CONST_ONGLET_DASHBOARD' ) ) {
    define( 'CONST_ONGLET_DASHBOARD', 1 );
}
if ( !defined( 'CONST_ONGLET_QUESTION' ) ) {
    define( 'CONST_ONGLET_QUESTION', 2 );
}
if ( !defined( 'CONST_ONGLET_PROFIL' ) ) {
    define( 'CONST_ONGLET_PROFIL', 3 );
}
if ( !defined( 'CONST_ONGLET_FACTURATION' ) ) {
    define( 'CONST_ONGLET_FACTURATION', 4 );
}
if ( !defined( 'CONST_ONGLET_CRIDONLINE' ) ) {
    define( 'CONST_ONGLET_CRIDONLINE', 5 );
}
if ( !defined( 'CONST_ONGLET_COLLABORATEUR' ) ) {
    define( 'CONST_ONGLET_COLLABORATEUR', 6 );
}
if ( !defined( 'CONST_ONGLET_MES_FACTURES' ) ) {
    define( 'CONST_ONGLET_MES_FACTURES', 7 );
}
if ( !defined( 'CONST_ONGLET_MES_RELEVES' ) ) {
    define( 'CONST_ONGLET_MES_RELEVES', 8 );
}
// capabilités d'aceès au solde
if ( !defined( 'CONST_ACCESS_SOLDE' ) ) {
    define( 'CONST_ACCESS_SOLDE', 'access_solde' );
}
// liste des categories notaires
if ( !defined( 'CONST_OFFICES_CATEG' ) ) {
    define( 'CONST_OFFICES_CATEG', 'OFF' );
}
if ( !defined( 'CONST_ORGANISMES_CATEG' ) ) {
    define( 'CONST_ORGANISMES_CATEG', 'ORG' );
}
if ( !defined( 'CONST_CLIENTDIVERS_CATEG' ) ) {
    define( 'CONST_CLIENTDIVERS_CATEG', 'DIV' );
}

// Start of block Import Facture
if ( !defined( 'CONST_TYPEFACTURE_CG' ) ) { // cotisation generale
    define( 'CONST_TYPEFACTURE_CG', 'CG' );
}
if ( !defined( 'CONST_TYPEFACTURE_CS' ) ) { // cotisation supplementaire
    define( 'CONST_TYPEFACTURE_CS', 'CS' );
}
if ( !defined( 'CONST_TYPEFACTURE_CRIDONLINE' ) ) { // cridonline
    define( 'CONST_TYPEFACTURE_CRIDONLINE', 'CRIDONLINE' );
}
if ( !defined( 'CONST_TYPEFACTURE_CONSULTATION' ) ) { // Consultation
    define( 'CONST_TYPEFACTURE_CONSULTATION', 'CONSULT' );
}
if ( !defined( 'CONST_TYPEFACTURE_DOSSIER' ) ) { // Dossier
    define( 'CONST_TYPEFACTURE_DOSSIER', 'DOSSIER' );
}
if ( !defined( 'CONST_TYPEFACTURE_SAF' ) ) { // service d'assistance fiscale
    define( 'CONST_TYPEFACTURE_SAF', 'SAF' );
}
if ( !defined( 'CONST_TYPEFACTURE_SEMINAIRE' ) ) { // Formation
    define( 'CONST_TYPEFACTURE_SEMINAIRE', 'SEMINAIRE' );
}
if ( !defined( 'CONST_TYPEFACTURE_TRADUC' ) ) { // traduction
    define( 'CONST_TYPEFACTURE_TRADUC', 'TRADUC' );
}
if ( !defined( 'CONST_TYPEFACTURE_OUVRAGE' ) ) { // Ouvrage
    define( 'CONST_TYPEFACTURE_OUVRAGE', 'OUVRAGE' );
}
if ( !defined( 'CONST_TYPEFACTURE_DIVERS' ) ) { // Divers
    define( 'CONST_TYPEFACTURE_DIVERS', 'DIVERS' );
}
if ( !defined( 'CONST_IMPORT_FACTURE_TEMP_PATH' ) ) { // repertoire d'echange avec ERP
    $uploadDir = wp_upload_dir();
    define( 'CONST_IMPORT_FACTURE_TEMP_PATH', $uploadDir['basedir'] . '/import/importsFacture/' );
}
if ( !defined( 'CONST_IMPORT_FACTURE_PATH' ) ) { // repertoire  avec ERP
    $uploadDir = wp_upload_dir();
    define( 'CONST_IMPORT_FACTURE_PATH', $uploadDir['basedir'] . '/factures/' );
}
if ( !defined( 'CONST_DOC_TYPE_FACTURE' ) ) { // valeur du champ cri_document.type
    define( 'CONST_DOC_TYPE_FACTURE', 'facture' );
}
if ( !defined( 'CONST_DOC_TYPE_REEVE_CONSO' ) ) { // valeur du champ cri_document.type
    define( 'CONST_DOC_TYPE_REEVE_CONSO', 'releveconso' );
}
// End of block Import Facture
if ( !defined( 'CONST_DISPLAYED' ) ) {
    define( 'CONST_DISPLAYED', 1 );
}



// Start of block Import Releveconso
if ( !defined( 'CONST_IMPORT_RELEVECONSO_TEMP_PATH' ) ) { // repertoire d'echange avec ERP
    $uploadDir = wp_upload_dir();
    define( 'CONST_IMPORT_RELEVECONSO_TEMP_PATH', $uploadDir['basedir'] . '/import/importsReleveconso/' );
}
if ( !defined( 'CONST_IMPORT_RELEVECONSO_PATH' ) ) { // emplacement definitif
    $uploadDir = wp_upload_dir();
    define( 'CONST_IMPORT_RELEVECONSO_PATH', $uploadDir['basedir'] . '/releveconso/' );
}
if ( !defined( 'CONST_DOC_TYPE_RELEVECONSO' ) ) { // valeur du champ cri_document.type
    define( 'CONST_DOC_TYPE_RELEVECONSO', 'releveconso' );
}
// End of block Import Releveconso

if ( !defined( 'CONST_YTRAITEE_PAR_SITE' ) ) {
    define( 'CONST_YTRAITEE_PAR_SITE', 0 );
}
// droit pour question ecrite au niveau ERP
if ( !defined( 'CONST_YSREECR_OFF' ) ) {
    define( 'CONST_YSREECR_OFF', 1 );
}
if ( !defined( 'CONST_YSREECR_ON' ) ) {
    define( 'CONST_YSREECR_ON', 2 );
}
// droit pour question telephonique au niveau ERP
if ( !defined( 'CONST_YSRETEL_OFF' ) ) {
    define( 'CONST_YSRETEL_OFF', 1 );
}
if ( !defined( 'CONST_YSRETEL_ON' ) ) {
    define( 'CONST_YSRETEL_ON', 2 );
}
if ( !defined( 'CONST_UPDATEERP_ERROR' ) ) {
    define( 'CONST_UPDATEERP_ERROR', 'Mise à jour données notaires (update) : %s' );
}
if ( !defined( 'CONST_DELCOLLAB_ERROR' ) ) {
    define( 'CONST_DELCOLLAB_ERROR', 'Mise à jour données notaires (suppression) : %s' );
}
if ( !defined( 'CONST_DATE_NULL_ORACLE' ) ) {
    define( 'CONST_DATE_NULL_ORACLE', '31/12/1599' );
}
if ( !defined( 'CONST_URL_SINEQUA' ) ) {
    define( 'CONST_URL_SINEQUA', '/rechercher-dans-les-bases-de-connaissances/' );
}
if ( !defined( 'CONST_URL_INFO_PAGE_CRIDONLINE' ) ) {
    define( 'CONST_URL_INFO_PAGE_CRIDONLINE', '/cridonline-decouvrir-nos-offres/' );
}

if ( !defined( 'CONST_URL_INFO_PAGE_CRIDONLINE_promo' ) ) { 
    define( 'CONST_URL_INFO_PAGE_CRIDONLINE_promo', '/cridonline-decouvrir-nos-offres-promotionnelles/' );
}



//Fax Not accepted after date
if ( !defined( 'CONST_DATE_FIN_FAX' ) ) {
    define( 'CONST_DATE_FIN_FAX', '2016-12-31' );
}
//Promo
if ( !defined( 'CONST_DATE_FIN_PROMO' ) ) {
    define( 'CONST_DATE_FIN_PROMO', '2016-09-30' );
}
if ( !defined( 'CONST_START_SUBSCRIPTION_PROMO_CHOC' ) ) {
    define( 'CONST_START_SUBSCRIPTION_PROMO_CHOC', '2017-01-01' );
}
if ( !defined( 'CONST_ECHEANCE_SUBSCRIPTION_PROMO_CHOC' ) ) {
    define( 'CONST_ECHEANCE_SUBSCRIPTION_PROMO_CHOC', '2017-10-31' );
}
if ( !defined( 'CONST_END_SUBSCRIPTION_PROMO_CHOC' ) ) {
    define( 'CONST_END_SUBSCRIPTION_PROMO_CHOC', '2017-12-31' );
}
if ( !defined( 'CONST_PROMO_CHOC' ) ) {
    define( 'CONST_PROMO_CHOC', 1 );
}
if ( !defined( 'CONST_PROMO_PRIVILEGE' ) ) {
    define( 'CONST_PROMO_PRIVILEGE', 2 );
}

if ( !defined( 'CRIDONLINE_AUTOLOGIN_URL' ) ) {
    switch ($env) {
        case PROD:
            // Proxy : http://abo.prod.wkf.fr/auth --> SERVER_NAME/wolters
            $url = '/wolters/autologin.js';
            break;
        case PREPROD:
        case DEV:
            $url= 'https://abo.prod.wkf.fr/auth/autologin.js';
            break;
        case LOCAL:
        default:
            $url = '/wolters/autologin.js';
            break;
    }
    define( 'CRIDONLINE_AUTOLOGIN_URL', $url);
}
