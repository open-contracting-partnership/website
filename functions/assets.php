<?php

use \App\Assets;

add_action('wp_enqueue_scripts', function() {

	// only use this method is we're not in wp-admin
	if ( ! is_admin() ) {


		 //****************
		// REGISTER ASSETS

		// BASE
		Assets::registerStyle('main', '/dist/css/styles.css');
		Assets::registerScript('main', '/dist/js/scripts.js', [], true);
		Assets::registerScript('header', '/dist/js/header.js', [], true);

		// EXTRACTED
		Assets::registerScript('manifest', '/dist/js/manifest.js', [], true);
		Assets::registerScript('vendor', '/dist/js/vendor.js', [], true);

		// SPECIFIC
		Assets::registerScript('latest-news', '/dist/js/latest-news.js', ['manifest', 'vendor'], TRUE);
		Assets::registerScript('page-worldwide', '/dist/js/worldwide.js', ['manifest', 'vendor'], TRUE);


		 //************
		// LOAD ASSETS

		wp_enqueue_style('main');
		wp_enqueue_script('main');
		wp_enqueue_script('header');

		if ( is_home() ) {
			wp_enqueue_script('latest-news');
		}

		// WORLDWIDE
		if ( basename(get_page_template()) === 'page-worldwide.php' ) {
			wp_enqueue_script('page-worldwide');
		}

	}

});
