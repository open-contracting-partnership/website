<?php

function vue_posts($args) {

	if ( ! isset($args['ignore']) ) {
		$args['ignore'] = array();
	}

	$query = new query_loop($args['query']);
	$vue_posts = [];
	$post_ids = [];


	foreach ( $query as $vue_post ) {

		// track the post ID
		$post_ids[] = $vue_post->ID;

		$vue_posts[$vue_post->ID] = array(
			'taxonomies' => array(),
			'custom' => array(),
			'display' => true
		);

		if ( ! in_array('id', $args['ignore']) ) {
			$vue_posts[$vue_post->ID]['id'] = get_the_ID();
		}

		if ( ! in_array('title', $args['ignore']) ) {
			$vue_posts[$vue_post->ID]['title'] = get_the_title();
		}

		if ( ! in_array('slug', $args['ignore']) ) {
			$vue_posts[$vue_post->ID]['slug'] = basename(get_the_permalink());
		}

		if ( ! in_array('content', $args['ignore']) ) {
			$vue_posts[$vue_post->ID]['content'] = wpautop(get_the_content());
		}

		if ( ! in_array('link', $args['ignore']) ) {
			$vue_posts[$vue_post->ID]['link'] = get_the_permalink();
		}

		if ( ! in_array('date', $args['ignore']) ) {
			$vue_posts[$vue_post->ID]['date'] = OCP::get_the_date();
		}


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
