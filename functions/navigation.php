<?php // navigation.php

/**
 * Get a menu as an array
 * @param  string $name
 * @return array
 */
function get_menu($name) {

	// get the menu
	$menu = wp_get_nav_menu_items($name);

	// apply any classes to the menu items
	_wp_menu_item_classes_by_context($menu);

	return $menu;

}


 //*************
// REGISTER NAV

add_action('after_setup_theme', function() {

	// header
	register_nav_menu('header-primary', __('Header: Primary', 'ocp'));
	register_nav_menu('header-secondary', __('Header: Secondary', 'ocp'));

	// footer
	register_nav_menu('footer-our-organisation', __('Footer: Our Organisation', 'ocp'));
	register_nav_menu('footer-open-contracting', __('Footer: Open Contracting', 'ocp'));
	register_nav_menu('footer-implement', __('Footer: Implement', 'ocp'));
	register_nav_menu('footer-stay-updated', __('Footer: Stay Updated', 'ocp'));
	register_nav_menu('footer-elsewhere-online', __('Footer: Elsewhere Online', 'ocp'));

});


 //***********
// BREACRUMBS

function get_breadcrumbs() {

	if ( is_search() ) {
		return array();
	}


	global $post;

	$post_type_object	= get_post_type_object($post->post_type);
	$breadcrumbs		= array();


	 //******************
	// FIRST LEVEL ITEMS

	// post type archive
	if ( is_post_type_archive() ) {
		$breadcrumbs[] = array(get_post_type_archive_link($post_type_object->name) => $post_type_object->label);
	}

	// is single or page but not the front-page
	if ( is_single() || ( is_page() && ! is_front_page() ) ) {

		$title = get_the_title($post->ID);

		if ( strlen($title) > 53 ) {
			$title = trim(substr($title, 0, 53)) . '&hellip;';
		}

		$breadcrumbs[] = array(get_permalink($post->ID) => $title);
	}

	// is blog or (specifically) a blog post
	if ( ( is_home() || ( is_single() && $post->post_type === 'post' ) ) && $posts_page_id = get_option('page_for_posts') ) {
		$breadcrumbs[] = array(get_permalink($posts_page_id) => get_the_title($posts_page_id));
	}

	if ( $post->post_parent ) {

		$parent_id = $post->post_parent;

		while ($parent_id) {

			$page = get_page($parent_id);
			$breadcrumbs[] = array(get_permalink($page->ID) => get_the_title($page->ID));
			$parent_id = $page->post_parent;

		}

	}

	// if this post type has it's own archive, output that
	if ( ( is_single() || is_page() ) AND $post_type_object->has_archive ) {

		// we want to do something a bit different if we're on a commitment
		if ( $post_type_object->name == 'commitment' ) {

			if ( $topic = get_field('topic') ) {

				// fetch the topic this commitment belongs to
				$topic = current($topic);

				// then output the topic archive and single links
				$breadcrumbs[] = array(get_permalink($topic->ID) => get_the_title($topic->ID));
				$breadcrumbs[] = array(get_post_type_archive_link('topic') => 'Topics');

			}

		} else {
			$breadcrumbs[] = array(get_post_type_archive_link($post_type_object->name) => $post_type_object->label);
		}

	}

	if ( isset($post_type_parents[$post->post_type]) ) {
		$breadcrumbs[] = array(get_permalink($post_type_parents[$post->post_type]) => get_the_title($post_type_parents[$post->post_type]));
	}

	$breadcrumbs[] = array('/' => 'Home');

	// remove the 'last' (it's first in the array) breadcrumb link
	$breadcrumbs[0] = array("" => current($breadcrumbs[0]));

	return array_reverse($breadcrumbs);

}
