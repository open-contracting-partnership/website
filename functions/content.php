<?php // functions/content.php

/**
 * return a formatted date from an acf metafield
 * @param  string $acf_field
 * @param  string $date_format
 * @return date
 */
function get_acf_date($acf_field, $date_format) {

	$date = get_field($acf_field);

	$year = substr($date, 0, 4);
	$month = substr($date, 4, 2);
	$day = substr($date, 6, 2);

	return date($date_format, mktime(0, 0, 0, $month, $day, $year));

}

/**
 * convert a string into a slug
 * @param  string $string
 * @return string
 */
function slugify($string) {

	// Remove accents from characters
	$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);

	// Everything lowercase
	$string = strtolower($string);

	// Replace all non-word characters by dashes
	$string = preg_replace("/\W/", "-", $string);

	// Replace double dashes by single dashes
	$string = preg_replace("/-+/", '-', $string);

	// Trim dashes from the beginning and end of string
	$string = trim($string, '-');

	return $string;

}

/**
 * generate WP video embed code based on url
 * @param  string $url
 */
function embed_video($url) {

	// we won't be able to use the [embed] shortcode yet
	// so lets call the shortcode function directly

	$wp_embed = new WP_Embed();
	echo $wp_embed->shortcode(array(), $url);

}

/**
 * extend WP_Query to filter by title
 * @param  string $where
 * @param  object $wp_query
 * @return string
 */
function title_filter($where, &$wp_query) {

	global $wpdb;

	if ( $search_term = $wp_query->get('search_post_title') ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
	}

	return $where;

}


 //********
// EXCERPT

$excerpt_length = 35;

/**
 * output custom excerpt length
 * @param integer $length
 */
function _the_excerpt($length = 35) {

	global $excerpt_length;

	$excerpt_length = $length;

	the_excerpt();

}

add_filter('excerpt_length', function($length) {
	global $excerpt_length;
	return $excerpt_length;
}, 999);

add_filter('wp_trim_excerpt', function($excerpt) {
	return str_replace( '[...]', '...', $excerpt );
});


 //************
// META VALUES

/**
 * returns array of post meta values
 * @param  string $key
 * @param  string $type
 * @param  string $status
 * @return array
 */
function get_meta_values($key = '', $type, $status = 'publish') {

	global $wpdb;

	if ( empty($key) ) {
		return FALSE;
	}

	$results = $wpdb->get_results(
		$wpdb->prepare("
			SELECT p.post_title, pm.post_id, pm.meta_value FROM {$wpdb->postmeta} pm
			LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
			WHERE pm.meta_key = '%s'
			AND p.post_status = '%s'
			AND p.post_type = '%s';
		", $key, $status, $type
	));

	$results_array = array();

	foreach ( $results as $key => $value ) {
		$results_array[$value->post_id] = maybe_unserialize($value->meta_value);
	}

	return $results_array;

}


 //*******
// LABELS

/**
 * returns the label for a given post type
 * @param  mixed $post_type
 * @param  boolean $plural
 * @return string
 */
function get_post_type_label($post_type = NULL, $plural = FALSE) {

	$post_type = $post_type === NULL ? get_post_type() : $post_type;
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

function get_authors() {

	// set the initial authors array as the normal post author...
	$authors = array(get_author_object());

	// but if multiple authors have been set, completely overwrite this array
	if ( have_rows('authors') ) {

		$authors = array();

		// loop through the rows of data
		while ( have_rows('authors') ) {

			the_row();

			switch ( get_row_layout() ) {

				case 'wordpress_user':
					$authors[] = get_author_object(get_sub_field('user')['ID']);
					break;

				case 'custom_user':
					$authors[] = (object) array('name' => get_sub_field('user'));
					break;

			}

		}

	}

	return $authors;

}

function get_author_object($author_id = NULL) {

	if ( ! $author_id ) {
		$author_id = get_the_author_meta('ID');
	}

	return (object) array(
		'name' => get_the_author_meta('display_name', $author_id),
		'url' => get_author_posts_url($author_id)
	);

}

function the_authors($with_links = FALSE) {

	$link_template = '<a href="%s">%s</a>';

	$authors = get_authors();

	foreach ( $authors as $key => $author ) {

		if ( $with_links && isset($author->url) ) {
			$authors[$key] = sprintf($link_template, $author->url, $author->name);
		} else {
			$authors[$key] = $author->name;
		}

	}

	echo array_multi_implode(', ', ' and ', $authors);

}

function share_links() {

	$url = urlencode(get_permalink());
	$title = wp_title('&raquo;', FALSE, 'right');

	return (object) array(
		'twitter' => "http://twitter.com/home?status={$title} - {$url} via @girlsnotbrides",
		'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$url}",
		'linkedin' => "https://www.linkedin.com/cws/share?url={$url}"
	);

}

function get_authors_by_count($limit = -1, $post_type = ['post']) {

	global $wpdb;

	$all_posts_query = "SELECT ID, post_author
		FROM {$wpdb->posts}
		WHERE post_type IN ('post');";

	$custom_authors_query = "SELECT {$wpdb->postmeta}.*
		FROM {$wpdb->postmeta}
		JOIN {$wpdb->posts} ON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id
		WHERE meta_key LIKE 'authors_%'
		AND {$wpdb->posts}.post_type IN ('post');";


 	$authors = array();
	$post_authors = array();
	$custom_post_authors = array();

	// get all posts with their standard authors
	foreach ( $wpdb->get_results($all_posts_query , OBJECT) as $author_post ) {
		$post_authors[$author_post->ID] = $author_post->post_author;
	}

	// get all custom authors
	foreach ( $wpdb->get_results($custom_authors_query , OBJECT) as $custom_author ) {

		// if the field isn't a number, forget about it
		if ( ! is_numeric($custom_author->meta_value) ) {
			continue;
		}

		// pre-set an array on the first time round
		if ( ! is_array($all_posts[$custom_author->post_id]) ) {
			$all_posts[$custom_author->post_id] = array();
		}

		// append the author to the posts
		$all_posts[$custom_author->post_id][] = (int) $custom_author->meta_value;

	}

	// reset each post_authors value to be an array
	foreach ( $post_authors as $key => $value ) {

		if ( ! is_array($value) ) {
			$post_authors[$key] = [$value];
		}

 	}

 	// reverse the array, authors first with sub-array of posts
 	foreach ( $post_authors as $post_id => $author_ids ) {

 		foreach ( $author_ids as $author_id ) {

 			if ( ! isset($authors[$author_id]) ) {
 				$authors[$author_id] = array();
 			}

 			$authors[$author_id][] = $post_id;

 		}

 	}

 	// transform the sub-array to a count
 	foreach ( $authors as $author_id => $author_posts ) {
 		$authors[$author_id] = count($author_posts);
 	}

 	// sort by the post count
 	arsort($authors);

 	if ( $limit > 0 ) {
 		$authors = array_slice($authors, 0, $limit, TRUE);
 	}

 	foreach ( $authors as $author_id => $post_count ) {

 		$authors[$author_id] = (object) array(
 			'id' => $author_id,
 			'post_count' => $post_count,
 			'display_name' => get_the_author_meta('display_name', $author_id),
 			'url' => get_author_posts_url($author_id)
 		);

 	}

 	return $authors;

}

function posted_ago() {

	$timestamp = get_the_time('U');
	$diff = time() - $timestamp;

	if ( $diff < 86400 ) {
		echo date('G', $diff) . 'h ago';
	} else if ( $diff < 432000 ) {
		echo date('j', $diff) . ' days ago';
	} else {
		echo date('d/m/y', $timestamp);
	}

}

function get_tweets() {

	require dirname(__FILE__) . '/../tweets/tweets.php';

	return display_latest_tweets('opencontracting');

}


 //*******************
// TITLE WIDOW FILTER

add_filter('the_title', function($title) {

	$minWords = 3;
	$arr = explode(' ', $title);

	if ( count($arr) >= $minWords ) {
		$arr[count($arr) - 2].= '&nbsp;' . $arr[count($arr) - 1];
		array_pop($arr);
		$title = implode(' ',$arr);
	}
	
	return $title;


}, 10, 1);
