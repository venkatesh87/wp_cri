<?php
/*
Plugin Name: Cridon
Plugin URI: 
Description: Extension permettant de gerer les API du Site
Author: Etech - Joelio
Version: 1.0
Author URI: 
*/

register_activation_hook(__FILE__, 'cridon_activate');
register_deactivation_hook(__FILE__, 'cridon_deactivate');

// load const
$dir = dirname(realpath(__FILE__));
require_once $dir . '/app/config/const.inc.php';
// load config
require_once $dir . '/app/config/config.php';
// load hook
require_once $dir . '/app/config/hook.inc.php';

function cridon_activate() {
    require_once dirname(__FILE__).'/cridon_loader.php';
    $loader = new CridonLoader();
    $loader->activate();
}

function cridon_deactivate() {
    require_once dirname(__FILE__).'/cridon_loader.php';
    $loader = new CridonLoader();
    $loader->deactivate();
}