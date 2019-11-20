<?php

namespace App\Cards;

class CarouselCard
{

	public static function buildPostById($post_id)
	{

		$data = array();

		$data['title'] = get_the_title($post_id);
		$data['url'] = get_the_permalink($post_id);
		$data['meta'] = get_the_date('j M Y', $post->ID);
		$data['type_label'] = get_post_type_label(get_post_type($post_id));

		return $data;

	}

	public static function convertTimberPost($post) {

		return [
			'title' => $post->post_title,
			'introduction' => $post->excerpt,
			'image' => $post->thumbnail->src,
			'url' => $post->link
		];

	}

}
