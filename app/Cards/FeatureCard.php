<?php

namespace App\Cards;

class FeatureCard extends BaseCard
{

	public static function buildPostById($post_id)
	{

		$data = array();

		$data['image_url'] = get_the_post_thumbnail_url($post_id) ?: null;
		$data['title'] = get_the_title($post_id);
		$data['url'] = get_the_permalink($post_id);
		$data['button_label'] = __('Read', 'ocp');

		return $data;

	}

	public static function convertTimberPost($post) {

		return [
			'image_url' => $post->thumbnail ? $post->thumbnail->src : null,
			'title' => $post->post_title,
			'url' => $post->link(),
			'button_label' => __('Read', 'ocp')
		];

	}

}
