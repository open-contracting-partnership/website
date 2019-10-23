<?php // functions/content.php


 //********
// EXCERPT

$excerpt_length = 15;

/**
 * output custom excerpt length
 * @param integer $length
 */
function _the_excerpt($length = 15) {

	global $excerpt_length;

	$excerpt_length = $length;

	the_excerpt();

}

add_filter('excerpt_length', function($length) {
	global $excerpt_length;
	return $excerpt_length;
}, 999);

add_filter('excerpt_more', function() {
	return '…';
});

function prevent_widow($text) {
	return preg_replace('|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', $text);
}


 //*****************
// POST TYPE LABELS

/**
 * returns the label for a given post type
 * @param  mixed $post_type
 * @param  boolean $plural
 * @return string
 */
function get_post_type_label($post_type = NULL, $plural = FALSE) {

	$post_type = $post_type ?: get_post_type();
	$post_type_object = get_post_type_object($post_type);
	$label = FALSE;

	if ( $post_type_object ) {

		if ( $plural === TRUE ) {
			$label = $post_type_object->labels->name;
		} else {
			$label = $post_type_object->labels->singular_name;
		}

	}

	return $label;

}

/**
 * echo alias of `get_post_type_label`
 * @param  mixed $post_type
 * @param  boolean $plural
 * @return NULL
 */
function the_post_type_label($post_type = NULL, $plural = FALSE) {
	echo get_post_type_label($post_type, $plural);
}
