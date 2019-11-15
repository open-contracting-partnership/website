<?php

namespace App\Cards;

class ResourceCard
{

	public static function buildPostById($post_id) {

		return [
			'title' => get_the_title($post_id),
			'url' => get_the_permalink($post_id),
			'type' => get_post_type($post_id),
			'type_label' => get_post_type_label(get_post_type($post_id))
		];

	}

	public static function convertTimberPost($post) {

		return [
			'title' => $post->post_title,
			'url' => $post->link,
			'type' => $post->post_type,
			'type_label' => get_post_type_label($post->post_type)
		];

	}

	public static function convertCollection($collection) {

		$new_collection = [];

		foreach ( $collection as $post ) {

			if ( is_int($post) ) {
				$new_collection[] = self::buildPostById($post);
			}

			if ( is_object($post) && get_class($post) === 'Timber\Post' ) {
				$new_collection[] = self::convertTimberPost($post);
			}

			if ( is_object($post) && get_class($post) === 'WP_Post' ) {
				$new_collection[] = self::buildPostById($post->ID);
			}

		}

		return $new_collection;

	}

}
