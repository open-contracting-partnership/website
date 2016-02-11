<?php

function vue_posts($args) {

	$query = new query_loop($args['query']);
	$vue_posts = [];
	$post_ids = [];


	foreach ( $query as $vue_post ) {

		// track the post ID
		$post_ids[] = $vue_post->ID;

		$vue_posts[$vue_post->ID] = array(
			'id' => get_the_ID(),
			'title' => get_the_title(),
			'slug' => basename(get_the_permalink()),
			'content' => wpautop(get_the_content()),
			'excerpt' => get_the_excerpt(),
			'link' => get_the_permalink(),
			'date' => get_the_time(get_option('date_format')),
			'taxonomies' => array(),
			'custom' => array(),
			'display' => true
		);

		if ( isset($args['taxonomies']) && ! empty($args['taxonomies']) ) {

			// loop through taxonomies
			foreach ( $args['taxonomies'] as $taxonomy ) {

				$vue_posts[$vue_post->ID]['taxonomies'][$taxonomy] = array();

				if ( $terms = get_the_terms($vue_post->ID, $taxonomy) ) {

					foreach ( $terms as $term ) {
						$vue_posts[$vue_post->ID]['taxonomies'][$taxonomy][$term->slug] = $term->name;
					}

				}

			}

		}

		if ( isset($args['fields']) ) {

			foreach ( $args['fields'] as $field ) {

				$value = get_field($field);

				if ( $value === NULL ) {
					$value = get_post_meta(get_the_ID(), $field, TRUE);
				}

				$vue_posts[$vue_post->ID]['fields'][$field] = $value;


			}

		}

		if ( isset($args['custom']) ) {

			foreach ( $args['custom'] as $custom => $callback ) {
				$vue_posts[$vue_post->ID]['custom'][$custom] = $callback($vue_post);
			}

		}

	}

	$vue_posts = array_values($vue_posts);

	return $vue_posts;

}
