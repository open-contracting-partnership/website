<?php // functions/loader.php


 //********************
// COMPOSER AUTOLOADER

require(get_theme_root() . '/' . get_template() . '/vendor/autoload.php');


 //***********************
// SENTRY ERROR REPORTING

$sentryClient = new Raven_Client('https://83ad0f87126d451bb12da818e5c7e46d@sentry.io/1369375');

$error_handler = new Raven_ErrorHandler($sentryClient);
$error_handler->registerExceptionHandler();
$error_handler->registerErrorHandler();
$error_handler->registerShutdownFunction();


 //****************
// THEME AUTLOADER

require(get_theme_root() . '/' . get_template() . '/classes/autoload.php');


 //*******************
// LOAD SIBLING FILES

// get the current path info
$function_path = pathinfo(__FILE__);

// loop through all php files within this functions directory...
foreach ( glob($function_path['dirname'] . '/*.php') as $file) {

	// and if it's not loader.php, include it
	if ( basename($file) !== 'loader.php' ) {
		include $file;
	}

}
