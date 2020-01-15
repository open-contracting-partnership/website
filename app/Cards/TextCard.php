<?php

namespace App\Cards;

class TextCard extends BaseCard
{

	public static function convertTimberPost($post) {

		return [
			'title' => $post->post_title,
			'url' => $post->link,
			'meta' => $post->date('j M Y')
		];

	}

}
