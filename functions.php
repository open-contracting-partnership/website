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

		$item->mega_menu = false;

		if ( $mega_menus ) {

			$mega_menu = array_filter($mega_menus, function($menu) use ($item){
				return $menu['parent'] == $item->id;
			});

			if ( $mega_menu ) {
				$item->mega_menu = current($mega_menu);
			}

		}

	}

	return $context;

});

add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}

function hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
          return $default;

	//Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}




function action_function_name( $field ) {
// echo '<pre>'; print_r($field); echo '</pre>';
	// echo '<p>Some extra HTML</p>';

}
add_action( 'acf/render_field', 'action_function_name', 10, 1 );



add_action('acf/render_field_settings', 'addFieldTranslationOption');

/**
 * Add "Translate field" option to ACF field, can then be used to translate
 * specific custom fields
 * @param array $field the field object
 */
function addFieldTranslationOption($field) {

	acf_render_field_setting($field, array(
		'label' => __('Gutenberg visibility'),
		'instructions' => 'Where should this field display within the Gutenberg editor?',
		'name' => 'gutenberg_visibility',
		'type' => 'select',
		'choices' => [
			'both' => 'Block Settings and Edit Screen',
			'block_settings' => 'Just Block Settings',
			'edit_screen' => 'Just Edit Screen',
		]
	), true);

}
