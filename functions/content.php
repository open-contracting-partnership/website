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
