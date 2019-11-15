<?php

namespace App\Cards;

class TextCard
{

	public static function buildData($post_id)
	{

		$data = array();

		$data['title'] = get_the_title($post_id);
		$data['url'] = get_the_permalink($post_id);
		$data['meta'] = get_the_date('j M Y', $post->ID);

		return $data;

	}

	public static function convertTimberCollection($collection) {

		$new_collection = [];

		foreach ( $collection as $post ) {

			if ( get_class($post) !== 'Timber\Post' ) {
				continue;
			}

			$new_collection[$post->ID] = [
				'title' => $post->post_title,
				'url' => $post->link,
				'meta' => $post->date('j M Y')
			];

		}

		return $new_collection;

	}

}
