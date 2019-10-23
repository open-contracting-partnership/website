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

}
