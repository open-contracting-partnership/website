<?php

namespace App\Cards;

class PrimaryCard
{

	public static function buildData($post_id)
	{

		$data = array();

		$data['image_url'] = get_the_post_thumbnail_url($post_id) ?: null;
		$data['title'] = get_the_title($post_id);
		$data['url'] = get_the_permalink($post_id);
		$data['meta'] = get_the_author_meta('display_name', get_post_field('post_author', $post_id));

		if ( get_post_type($post_id) === 'post' ) {
			$data['type_label'] = 'Blog';
		}

		if ( get_post_type($post_id) === 'news' ) {
			$data['type_label'] = 'News';
		}

		$data['button_label'] = __('Read', 'ocp');

		return $data;

	}

	public static function convertTimberCollection($collection) {

		if ( get_class($collection) !== 'Tightenco\Collect\Support\Collection' ) {
			return false;
		}

		$new_collection = [];

		foreach ( $collection as $post ) {

			$new_collection[$post->ID] = [
				'title' => $post->post_title,
				'url' => $post->link,
				'meta' => $post->author ? $post->author->name : null,
				'image_url' => $post->thumbnail ? $post->thumbnail->src : null,
				'type_label' => get_post_type_label($post->post_type),
				'button_label' => __('Read', 'ocp')
			];

		}

		return $new_collection;

	}

}
