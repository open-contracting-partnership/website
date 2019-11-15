<?php

namespace App\Cards;

class TextCard
{

	public static function buildPostById($post_id) {

		return [
			'title' => get_the_title($post_id),
			'url' => get_the_permalink($post_id),
			'meta' => get_the_date('j M Y', $post_id)
		];

	}

	public static function convertTimberPost($post) {

		return [
			'title' => $post->post_title,
			'url' => $post->link,
			'meta' => $post->date('j M Y')
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
