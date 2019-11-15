<?php

namespace App\Cards;

class ResourceCard
{

	public static function buildData($post_id)
	{

		$data = array();

		$data['title'] = get_the_title($post_id);
		$data['url'] = get_the_permalink($post_id);
		$data['type'] = get_post_type($post_id);
		$data['type_label'] = get_post_type_label(get_post_type($post_id));

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
				'type' => $post->post_type,
				'type_label' => get_post_type_label($post->post_type)
			];

		}

		return array_values($new_collection);

	}

}
