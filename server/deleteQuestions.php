<?php
/**
 * Created by JETPULP.
 * User: valbert
 * Date: 12/12/2015
 * Time: 11:39
 */
// set utf-8 encoding
header('Content-type: text/plain; charset=utf-8');
if (!defined( 'WP_ADMIN' )) {
    define('WP_ADMIN', true);
}
// load WP Core
require_once './wp-load.php';

//array of questions ids to delete
$questionsToDelete = array(
    '',
    '',
);


/**
 * @var $model Question
 */
$model = mvc_model('Question');
// deleteQuestions and documents associated
echo $model->deleteQuestions($questionsToDelete);
