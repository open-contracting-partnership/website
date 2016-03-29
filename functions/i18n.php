<?php

if ( ! function_exists('pll_e') ) {

	function pll_e($string) {
		echo $string;
	}

}

if ( ! function_exists('pll__') ) {

	function pll__($string) {
		return $string;
	}

}

// unset translation support for posts
// only pages will be translatable

add_filter('pll_get_post_types', function($types) {
	unset ($types['post']);
	return $types;
});
