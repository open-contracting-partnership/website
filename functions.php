<?php

require get_theme_root() . '/' . get_template() . '/vendor/autoload.php';

use App\Http\Lumberjack;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

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

function hex2rgba(string $color, float $opacity = 1.0): string
{
    $default = 'rgb(0,0,0)';

    // Return default if no color provided
    if (empty($color)) {
        return $default;
    }

    // Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    // Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif (strlen($color) == 3) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    // Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    // check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1) {
            $opacity = 1.0;
        }

        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    // return rgb(a) color string
    return $output;
}

/**
 * Increases or decreases the brightness of a color by a percentage of the current brightness.
 *
 * @param   string  $hexCode        Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 * @param   float   $adjustPercent  A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
 *
 * @return  string
 *
 * @author  maliayas
 */
function adjustBrightness($hexCode, $adjustPercent)
{
    $hexCode = ltrim($hexCode, '#');

    if (strlen($hexCode) == 3) {
        $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
    }

    $hexCode = array_map('hexdec', str_split($hexCode, 2));

    foreach ($hexCode as & $color) {
        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
        $adjustAmount = ceil($adjustableLimit * $adjustPercent);

        $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
    }

    return '#' . implode($hexCode);
}

function humanDateRanges(string $start, string $end): string
{
    $startTime = strtotime($start);
    $endTime = strtotime($end);
    $divider = '-';

    if (date('Y', $startTime) != date('Y', $endTime)) {
        // diff years
        $start = date('F j, Y', $startTime);
        $end = date('F j, Y', $endTime);
    } else {
        // same years
        $start = date('j F', $startTime);
        $end = date('j F Y', $endTime);

        // same months
        if (date('m', $startTime) == date('m', $endTime)) {
            $start = date('j', $startTime);

            // same days
            if (date('d', $startTime) == date('d', $endTime)) {
                return date('j F Y', $startTime);
            }
        }
    }

    return sprintf(
        '%s %s %s',
        $start,
        $divider,
        $end
    );
}

add_action('acf/render_field_settings', 'addFieldTranslationOption');

/**
 * Add "Translate field" option to ACF field, can then be used to translate
 * specific custom fields
 * @param array $field the field object
 */
function addFieldTranslationOption(array $field): void
{
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

//***********
// TAXONOMIES

// an array of taxonomies that will be used to efficiently create
// and handle the wordpress taxonomy and removal of ui elements

$taxonomies = array(
    'issue' => array(
        'label' => 'Issue',
        'post_type' => ['post', 'news', 'event', 'resource']
    ),
    'resource-type' => array(
        'label' => 'Resource Type',
        'post_type' => ['resource']
    ),
    'region' => array(
        'label' => 'Region',
        'post_type' => ['post', 'news', 'event', 'resource']
    ),
    'country' => array(
        'label' => 'Country',
        'post_type' => ['post', 'news', 'event', 'resource']
    ),
    'open-contracting' => array(
        'label' => 'Open Contracting',
        'post_type' => ['post', 'news', 'event', 'resource']
    ),
    'audience' => array(
        'label' => 'Audience',
        'post_type' => ['post', 'news', 'event', 'resource']
    ),
    'story-type' => array(
        'label' => 'Story Type',
        'post_type' => ['page']
    ),
    'story-content-type' => array(
        'label' => 'Story Content Type',
        'post_type' => ['page']
    )
);

foreach ($taxonomies as $taxonomy => $options) {
    register_taxonomy(
        $taxonomy,
        $options['post_type'],
        array(
            'labels' => array(
                'name' => $options['label'],
                'add_new_item' => 'Add New ' . $options['label'],
                'new_item_name' => "New " . $options['label']
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'rewrite' => array('slug' => $taxonomy, 'with_front' => false)
        )
    );

    if (is_admin()) {
        add_action('admin_menu', function () use ($taxonomy, $options) {

            foreach ($options['post_type'] as $post_type) {
                remove_meta_box($taxonomy . 'div', $post_type, 'side');
            }
        });
    }
}
