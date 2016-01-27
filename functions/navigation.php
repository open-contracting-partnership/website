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
	register_nav_menu('header-primary', __('Header Primary', 'ocp'));
	register_nav_menu('header-secondary', __('Header Secondary', 'ocp'));

	// footer
	register_nav_menu('footer-our-organisation', __('Footer: Our Organisation', 'ocp'));
	register_nav_menu('footer-open-contracting', __('Footer: Open Contracting', 'ocp'));
	register_nav_menu('footer-implement', __('Footer: Implement', 'ocp'));
	register_nav_menu('footer-stay-updated', __('Footer: Stay Updated', 'ocp'));
	register_nav_menu('footer-elsewhere-online', __('Footer: Elsewhere Online', 'ocp'));

});
