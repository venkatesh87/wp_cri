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
        }
    }
}
add_action( 'admin_menu', 'custom_admin_menu', 100 );