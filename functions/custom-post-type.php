<?php // functions/custom-post-types.php


 //*******
// LABELS

function create_post_type_labels($singular, $plural = NULL) {

	$plural = $plural === NULL ? $singular . 's' : $plural;

	return array(
		'name'					=> $plural,
		'singular_name'			=> $singular,
		'add_new'				=> 'Add ' . $singular,
		'add_new_item'			=> 'Add New ' . $singular,
		'edit_item'				=> 'Edit ' . $singular,
		'new_item'				=> 'New ' . $singular,
		'view_item'				=> 'View ' . $singular,
		'search_items'			=> 'Search ' . $plural,
		'not_found'				=> 'No ' . strtolower($plural) . ' found',
		'not_found_in_trash'	=> 'No ' . strtolower($plural) . ' found in Trash',
		'parent_item_colon'		=> ''
	);

}


 //*****************
// CUSTOM POST TYPE

register_post_type('news', array(
	'labels'				=> create_post_type_labels('News', 'News'),
	'public'				=> TRUE,
	'query_var'				=> TRUE,
	'rewrite'				=> array('slug' => 'news', 'with_front' => FALSE),
	'capability_type'		=> 'post',
	'taxonomies'			=> array(),
	'supports'				=> array('title', 'editor'),
	'has_archive'			=> FALSE,
	'menu_position'			=> 5
));

register_post_type('event', array(
	'labels'				=> create_post_type_labels('Event'),
	'public'				=> TRUE,
	'query_var'				=> TRUE,
	'rewrite'				=> array('slug' => 'event', 'with_front' => FALSE),
	'capability_type'		=> 'post',
	'taxonomies'			=> array(),
	'supports'				=> array('title', 'editor'),
	'has_archive'			=> FALSE
));

register_post_type('resource', array(
	'labels'				=> create_post_type_labels('Resource'),
	'public'				=> TRUE,
	'query_var'				=> TRUE,
	'rewrite'				=> array('slug' => 'resource', 'with_front' => FALSE),
	'capability_type'		=> 'post',
	'taxonomies'			=> array(),
	'supports'				=> array('title', 'editor', 'thumbnail'),
	'has_archive'			=> FALSE
));

register_post_type('success-story', array(
	'labels'				=> create_post_type_labels('Success Story', 'Success Stories'),
	'public'				=> TRUE,
	'query_var'				=> TRUE,
	'rewrite'				=> array('slug' => 'success-story', 'with_front' => FALSE),
	'capability_type'		=> 'post',
	'taxonomies'			=> array(),
	'supports'				=> array('title', 'editor', 'thumbnail'),
	'has_archive'			=> FALSE
));

register_post_type('policy', array(
	'labels'				=> create_post_type_labels('Policy', 'Policies'),
	'public'				=> TRUE,
	'query_var'				=> TRUE,
	'rewrite'				=> array('slug' => 'policy', 'with_front' => FALSE),
	'capability_type'		=> 'post',
	'taxonomies'			=> array(),
	'supports'				=> array('title', 'editor'),
	'has_archive'			=> FALSE
));

register_post_type('newsletter', array(
	'labels'				=> create_post_type_labels('Newsletter'),
	'public'				=> TRUE,
	'query_var'				=> TRUE,
	'rewrite'				=> array('slug' => 'newsletter', 'with_front' => FALSE),
	'capability_type'		=> 'post',
	'taxonomies'			=> array(),
	'supports'				=> array('title', 'thumbnail'),
	'has_archive'			=> FALSE
));

register_post_type('media-clipping', array(
	'labels'				=> create_post_type_labels('Media Clipping'),
	'public'				=> TRUE,
	'query_var'				=> TRUE,
	'rewrite'				=> array('slug' => 'media-clipping', 'with_front' => FALSE),
	'capability_type'		=> 'post',
	'taxonomies'			=> array(),
	'supports'				=> array('title'),
	'has_archive'			=> FALSE
));


 //***********
// TAXONOMIES

// an array of taxonomies that will be used to efficiently create
// and handle the wordpress taxonomy and removal of ui elements

$taxonomies = array(

	'issue' => array(
		'label' => 'Issue',
		'post_type' => ['post', 'news', 'event', 'resource', 'success-story', 'newsletter', 'media-clipping']
	),
	'resource-type' => array(
		'label' => 'Resource Type',
		'post_type' => ['resource']
	),
	'region' => array(
		'label' => 'Region',
		'post_type' => ['post', 'news', 'event', 'resource', 'success-story', 'newsletter', 'media-clipping']
	),
	'country' => array(
		'label' => 'Country',
		'post_type' => ['post', 'news', 'event', 'resource', 'success-story', 'newsletter', 'media-clipping']
	),
	'open-contracting' => array(
		'label' => 'Open Contracting',
		'post_type' => ['post', 'news', 'event', 'resource', 'success-story']
	),
	'audience' => array(
		'label' => 'Audience',
		'post_type' => ['post', 'news', 'event', 'resource', 'success-story']
	)

);

foreach ( $taxonomies as $taxonomy => $options ) {

	register_taxonomy(
		$taxonomy,
		$options['post_type'],
		array(
			'labels' => array(
				'name' => $options['label'],
				'add_new_item' => 'Add New ' . $options['label'],
				'new_item_name' => "New " . $options['label']
			),
			'show_ui' => TRUE,
			'show_tagcloud' => FALSE,
			'hierarchical' => TRUE,
			'rewrite' => array('slug' => $taxonomy, 'with_front' => FALSE)
		)
	);

	if ( is_array($options['post_type']) && is_admin() ) {

		add_action('admin_menu', function() use ($taxonomy, $options) {

			foreach ( $options['post_type'] as $post_type ) {
				remove_meta_box($taxonomy . 'div', $post_type, 'side');
			}

		});

	}

}


 //*************
// RENAME POSTS

function change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Blog';
}

function change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Blog';
	$labels->singular_name = 'Blog';
	$labels->add_new = 'Add Blog Post';
	$labels->add_new_item = 'Add Blog Post';
	$labels->edit_item = 'Edit Blog Post';
	$labels->new_item = 'Blog';
	$labels->view_item = 'View Blog Post';
	$labels->search_items = 'Search blog posts';
	$labels->not_found = 'No blog posts found';
	$labels->not_found_in_trash = 'No blog posts found in Trash';
}

add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );
