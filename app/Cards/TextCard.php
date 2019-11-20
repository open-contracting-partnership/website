<?php

namespace App\Cards;

class TextCard extends BaseCard
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

}
