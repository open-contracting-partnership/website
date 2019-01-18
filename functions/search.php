<?php

/**
 * fetch an arrya of user ids that mach a user display name
 * @param  string $search_term
 * @return array
 */
function search_get_user($search_term) {

	add_filter('pre_user_query', 'db_filter_user_query');

	$matching_users = get_users(['
		count_total' => false,
		'search' => sprintf( '*%s*', $search_term ),
		'search_fields' => array(
			'display_name',
			'user_login',
		),
		'fields' => 'ID'
	]);

	remove_filter('pre_user_query', 'db_filter_user_query');

	return $matching_users;

}

/**
 * pre_user_query filter to change user search from username to display name
 * @param  object $user_query
 * @return object
 */
function db_filter_user_query(&$user_query) {

	if ( is_object($user_query) ) {
		$user_query->query_where = str_replace( "user_nicename LIKE", "display_name LIKE", $user_query->query_where );
	}

	return $user_query;

}

/**
 * fetch array of post ids that match an author search
 * @return array
 */
function get_search_author_post_ids() {

	global $wpdb;

	$post_ids = array();

	$search = sanitize_text_field(get_query_var('s'));
	$matching_users = search_get_user($search);

	// field, plain text
	$post_ids = array_merge($post_ids, $wpdb->get_col("SELECT post_id FROM $wpdb->postmeta WHERE meta_key LIKE 'authors_%' AND meta_value LIKE '%" . $search . "%';"));

	// field, users
	if ( ! empty($matching_users) ) {
		$post_ids = array_merge($post_ids, $wpdb->get_col("SELECT post_id FROM $wpdb->postmeta WHERE meta_key LIKE 'authors_%' AND meta_value IN (" . implode(', ', $matching_users) . ");"));
	}

	return $post_ids;

}
