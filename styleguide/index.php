<?php

session_start();

// set the various path variables for the styleguide
// NOTE: this is probably the suckiest way of doing this, but i'm
// unsure about sending lots of data via the iframe src attribute

$_SESSION['styleguide_paths'] = array(

	// specify the url to the assets folder
	'assets_url' => '/',

	// specify the path to the assets 
	'templates_path' => dirname(__FILE__) . '/templates/',

	// specify the url to the styleguide core
	'core_url' => '/styleguide/core',

	// specify the path to the styleguide core
	'core_path' => dirname(__FILE__) . '/core',

);

// debug the session vars
if ( FALSE ) {
	die('<pre>' . print_r($_SESSION['styleguide_paths'], TRUE) . '</pre>');
}

// throw a message if 
if ( ! file_exists('core/index.php') ) {
	die('<p><strong>Error:</strong> Style guide core not found. Please run `yo` to install the style guide core</p>');
}

require('core/index.php');