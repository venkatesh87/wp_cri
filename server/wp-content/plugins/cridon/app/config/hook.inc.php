<?php
/**
 * Description of hook.inc.php
 * @package wp_cridon
 * @author ETECH
 * @contributor Joelio
 */

/**
 * Hook admin menu
 *
 * @param string $parent_file
 *
 * @return string
 */
function hook_admin_menu($parent_file)
{
    global $submenu_file;
    if (isset( $_GET['cridon_type'] ) && $_GET['cridon_type'] ) {
        $submenu_file = 'post-new.php?cridon_type=' . $_GET['cridon_type'];
        $parent_file  = CONST_WPMVC_PREFIX . $_GET['cridon_type'];
    }else{
        //Correction bug WP_MVC
        //Au niveau du menu de l'admin, lors de l'edition d'un modèle il ne s'ouvre pas.
        if( isset( $_GET['page'] ) ){
            //Seulement pour le menu lié à  WP_MVC
            if ( preg_match( '/' . CONST_WPMVC_PREFIX . '(.*)/', $_GET['page'], $match ) ) {
                  if( isset( $match[0] ) ){
                      $tab = explode( '-',$match[0] );
                      if( ( count( $tab ) > 1 ) && ( $tab[1] === 'edit' ) ){//Seulement pour l'édition
                          $parent_file = $tab[0];                          
                      }
                  }
            }            
        }
    }
    return $parent_file;
}
add_filter('parent_file', 'hook_admin_menu');

/**
 * Hook for WP-MCV menu
 */
function custom_admin_menu()
{
    global $submenu;

    foreach ($submenu as $k => $d) {
        if (preg_match('/' . CONST_WPMVC_PREFIX . '(.*)/', $k, $match)) {
            if (in_array($match[1], Config::$mvcWithPostForm)) {
                $submenu[$k][1][2] = 'post-new.php?cridon_type=' . $match[1];
            }
            if (in_array($match[1], Config::$mvcWithUserForm)) {
                $submenu[$k][1][2] = 'user-new.php?cridon_user_type=' . $match[1];
            }
        }
    }
}
add_action( 'admin_menu', 'custom_admin_menu', 100 );

/**
 * Add custom js in template
 */
function append_js_files()
{
    require_once ABSPATH . WPINC . '/pluggable.php';

    // only in front
    if (!is_admin()) {

        wp_enqueue_script('cridon', plugins_url('cridon/app/public/js/cridon_login.js'), array('jquery'));
        wp_localize_script(
            'cridon',
            'jsvar',
            array(
                'ajaxurl'                  => admin_url('admin-ajax.php'),
                // connection
                'login_nonce'              => wp_create_nonce("process_login_nonce"),
                'error_msg'                => CONST_LOGIN_ERROR_MSG,
                'empty_error_msg'          => CONST_LOGIN_EMPTY_ERROR_MSG,
                'form_id'                  => CONST_TPL_FORM_ID,
                'login_field_id'           => CONST_TPL_LOGINFIELD_ID,
                'password_field_id'        => CONST_TPL_PASSWORDFIELD_ID,
                'error_bloc_id'            => CONST_TPL_ERRORBLOCK_ID,
                // lost password
                'lostpwd_nonce'            => wp_create_nonce("process_lostpwd_nonce"),
                'pwdform_id'               => CONST_TPL_PWDFORM_ID,
                'pwdmsg_block'             => CONST_TPL_PWDMSGBLOCK_ID,
                'email_field_id'           => CONST_TPL_PWDEMAILFIELD_ID,
                'crpcen_field_id'          => CONST_TPL_CRPCENFIELD_ID,
                'crpcen_error_msg'         => CONST_INVALIDEMAIL_ERROR_MSG,
                'crpcen_success_msg'       => CONST_RECOVPASS_SUCCESS_MSG,
                'empty_crpcen_msg'         => CONST_CRPCEN_EMPTY_ERROR_MSG,
                // post question
                'question_form_id'         => CONST_QUESTION_FORM_ID,
                'question_nonce'           => wp_create_nonce("process_question_nonce"),
                'question_support'         => CONST_QUESTION_SUPPORT_FIELD,
                'question_matiere'         => CONST_QUESTION_MATIERE_FIELD,
                'question_competence'      => CONST_QUESTION_COMPETENCE_FIELD,
                'question_objet'           => CONST_QUESTION_OBJECT_FIELD,
                'question_message'         => CONST_QUESTION_MESSAGE_FIELD,
                'question_fichier'         => CONST_QUESTION_ATTACHEMENT_FIELD,
                'question_msgblock'        => CONST_QUESTION_SUCCESS_MSG_FIELD,
                'question_content'         => CONST_QUESTION_ACTION_SUCCESSFUL,
                'question_nb_file'         => CONST_QUESTION_MAX_FILES,
                'question_nb_file_error'   => sprintf(CONST_QUESTION_MAX_FILES_ERROR, CONST_QUESTION_MAX_FILES),
                'question_max_file_size'   => CONST_QUESTION_MAX_FILE_SIZE,
                'question_file_size_error' => sprintf(CONST_QUESTION_FILE_SIZE_ERROR,
                                                      (CONST_QUESTION_MAX_FILE_SIZE / 1000000) . 'M'),
            )
        );
    }
}
add_action('wp_enqueue_scripts', append_js_files(), 99);

/**
 * hook for connection
 */
function logins_connect()
{
    require_once WP_PLUGIN_DIR . '/cridon/app/controllers/logins_controller.php';
    $controller = new LoginsController();
    $controller->connect();
}
add_action( 'wp_ajax_logins_connect',   'logins_connect' );
add_action( 'wp_ajax_nopriv_logins_connect',   'logins_connect' );

/**
 * hook for lost password
 */
function lost_password()
{
    require_once WP_PLUGIN_DIR . '/cridon/app/controllers/logins_controller.php';
    $controller = new LoginsController();
    $controller->lostPassword();
}
add_action( 'wp_ajax_lost_password',   'lost_password' );
add_action( 'wp_ajax_nopriv_lost_password',   'lost_password' );

/**
 * hook for add question
 *
 * Only for connected user
 */
function add_question()
{
    require_once WP_PLUGIN_DIR . '/cridon/app/controllers/questions_controller.php';
    $controller = new QuestionsController();
    $controller->add();
}
add_action( 'wp_ajax_add_question',   'add_question' );

/**
 * Hook for logout
 */
function custom_logout_redirect()
{
    global $current_user;

    if ($current_user->roles[0] !== CONST_ADMIN_ROLE) {
        wp_redirect( home_url() );
        exit();
    }
}
add_action('wp_logout','custom_logout_redirect');

/**
 * Hook for wp_mail_from plugged to wordpress@sitename by default
 *
 * @param $email
 * @return string
 */
function cridon_mail_from( $email )
{
    return CONST_EMAIL_SENDER_CONTACT;
}
add_filter( 'wp_mail_from', 'cridon_mail_from' );

/**
 * Hook for cridon_mail_from_name plugged to Wordpress by default
 *
 * @param $name
 * @return string
 */
function cridon_mail_from_name( $name )
{
    return CONST_EMAIL_SENDER_NAME;
}
add_filter( 'wp_mail_from_name', 'cridon_mail_from_name' );


add_action('wp_head', 'custom_remove_admin_bar');
function custom_remove_admin_bar() {
    //Remove admin bar in front for notaire
    if( CriIsNotaire() ){
        show_admin_bar(false);
    }
}
