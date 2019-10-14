<?php

require get_theme_root() . '/' . get_template() . '/vendor/autoload.php';

use App\Http\Lumberjack;

// Create the Application Container
$app = require_once('bootstrap/app.php');

// Bootstrap Lumberjack from the Container
$lumberjack = $app->make(Lumberjack::class);
$lumberjack->bootstrap();

// Import our routes file
require_once('routes.php');

// Load the functions directory
require_once('functions/loader.php');

// Set global params in the Timber context
add_filter('timber/context', [$lumberjack, 'addToContext']);

// set header and footer
add_filter('timber/context', function($context) {

	$context['header_primary_menu'] = new \Timber\Menu('Header: Primary');
	$context['header_secondary_menu'] = new \Timber\Menu('Header: Secondary');
	$context['search_term'] = get_search_query();

	// fetch the menu
	$mega_menus = get_field('mega_menu', 'options');

	foreach ( $context['header_primary_menu']->items as &$item ) {

		$mega_menu = array_filter($mega_menus, function($menu) use ($item){
			return $menu['parent'] == $item->id;
		});

		$item->mega_menu = false;

		if ( $mega_menu ) {
			$item->mega_menu = $mega_menu[0];
		}

	}

	return $context;

});
