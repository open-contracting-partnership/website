<?php

use \App\Assets;

add_action('wp_enqueue_scripts', function() {

	// only use this method is we're not in wp-admin
	if ( ! is_admin() ) {

		wp_register_style('typekit', 'https://use.typekit.net/xpw3jps.css');
		Assets::registerStyle('main', '/dist/css/styles.css', ['typekit']);



		// // extracted
		Assets::registerScript('manifest', '/dist/js/manifest.js', [], true);
		Assets::registerScript('vendor', '/dist/js/vendor.js', [], true);

		Assets::registerScript('element-queries', '/dist/js/element-queries.js', ['manifest']);

		// JQUERY
		wp_deregister_script('jquery');
		Assets::registerScript('jquery', '/resources/js/libs/jquery-2.1.4.min.js', [], '2.1.4');

        // BASE
        Assets::registerScript('base', '/dist/js/main.js', ['manifest', 'jquery'], TRUE);


		// SLICK
		Assets::registerScript('slick-slider', '/public/js/libs/slick-slider/slick.min.js', ['base']);
		Assets::registerStyle('slick-slider', '/public/js/libs/slick-slider/slick.css');

		// SPECIFIC
		Assets::registerScript('page-worldwide', '/dist/js/worldwide.js', ['manifest', 'vendor'], TRUE);
		Assets::registerScript('page-get-started', '/dist/js/get-started.js', ['manifest', 'vendor'], TRUE);
		Assets::registerScript('page-impact-stories', '/dist/js/impact-stories.js', ['manifest', 'vendor'], TRUE);
		Assets::registerScript('resources', '/dist/js/resources.js', ['manifest', 'vendor'], TRUE);
		Assets::registerScript('latest-news', '/dist/js/latest-news.js', ['manifest', 'vendor'], TRUE);
		Assets::registerScript('events', '/dist/js/events.js', ['manifest', 'vendor'], TRUE);
		Assets::registerScript('archive', '/dist/js/archive.js', ['manifest', 'vendor'], TRUE);


         //***************
        // LOADING ASSETS

		global $post;

		wp_enqueue_style('main');
        wp_enqueue_script('base');

		// presently only the [related] shortcode uses element queries
		if ( is_singular() && has_shortcode($post->post_content, 'related') ) {
			wp_enqueue_script('element-queries');
		}

		// worldwide
		if ( basename(get_page_template()) === 'page-worldwide.php' ) {
			wp_enqueue_script('page-worldwide');
		}

		// get started
		if ( basename(get_page_template()) === 'page-implement.php' ) {
			wp_enqueue_script('page-get-started');
		}

		// impact stories
		if ( basename(get_page_template()) === 'page-impact-stories.php' ) {
			wp_enqueue_script('page-impact-stories');
		}

		// advisory board
		if ( basename(get_page_template()) === 'page-advisory-board.php' ) {
			wp_enqueue_script('slick-slider');
			wp_enqueue_style('slick-slider');
		}

		// advisory board
		if ( is_home() ) {
			wp_enqueue_script('latest-news');
		}

		// national partnership
        if ( is_archive() && get_post_type() === 'event' ) {
			wp_enqueue_script('events');
        }

		// resources
        if ( is_archive() && get_post_type() === 'resource' ) {
			wp_enqueue_script('resources');
        }
		// archive
        if ( is_author() || is_tag() ) {
			wp_enqueue_script('archive');
        }

	}

});
