<?php

use \App\Assets;

add_action('wp_enqueue_scripts', function() {

	// only use this method is we're not in wp-admin
	if ( ! is_admin() ) {


         //****************
        // REGISTER ASSETS

		Assets::registerStyle('main', '/dist/css/styles.css');
		Assets::registerScript('main', '/dist/js/scripts.js', [], true);
		Assets::registerScript('header', '/dist/js/header.js', [], true);


         //************
        // LOAD ASSETS

		wp_enqueue_style('main');
		wp_enqueue_script('main');
		wp_enqueue_script('header');

	}

});
