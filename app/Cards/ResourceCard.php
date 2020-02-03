<?php

namespace App\Cards;

class ResourceCard extends BaseCard
{

	public static function convertTimberPost($post) {

		return [
			'title' => $post->post_title,
			'url' => $post->link(),
			'type' => $post->post_type,
			'type_label' => get_post_type_label($post->post_type)
		];

	}

}
