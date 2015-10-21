<?php
/**
 * Description of const.inc.php
 * @package wp_cridon
 * @author Etech
 * @contributor Joelio
 */

// notaire
if ( !defined( 'CONST_NOTAIRE_ROLE' ) ) {
	define( 'CONST_NOTAIRE_ROLE', 'notaire' );
}

// wpmvc prefix
if ( !defined( 'CONST_WPMVC_PREFIX' ) ) {
	define( 'CONST_WPMVC_PREFIX', 'mvc_' );
}

// ODBC
if ( !defined( 'CONST_ODBC_DRIVER' ) ) {
	define( 'CONST_ODBC_DRIVER', '{SQL Server Native Client 10.0}' );
}
if ( !defined( 'CONST_ODBC_HOST' ) ) {
	define( 'CONST_ODBC_HOST', 'localhost' );
}
if ( !defined( 'CONST_ODBC_PORT' ) ) {
	define( 'CONST_ODBC_PORT', 1433 );
}
if ( !defined( 'CONST_ODBC_USER' ) ) {
	define( 'CONST_ODBC_USER', 'user' );
}
if ( !defined( 'CONST_ODBC_PASSWORD' ) ) {
	define( 'CONST_ODBC_PASSWORD', '' );
}
if ( !defined( 'CONST_ODBC_DATABASE' ) ) {
	define( 'CONST_ODBC_DATABASE', 'cridon' );
}
if ( !defined( 'CONST_ODBC_TABLE_NOTAIRE' ) ) {
	define( 'CONST_ODBC_TABLE_NOTAIRE', 'notaire' );
}

// import CSV notaire file path
if ( !defined( 'CONST_IMPORT_CSV_NOTAIRE_FILE_PATH' ) ) {
    define( 'CONST_IMPORT_CSV_NOTAIRE_FILE_PATH', 'PATH_TO_CSV_FILE' );
}
