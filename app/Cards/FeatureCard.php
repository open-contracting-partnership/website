<?php

namespace App\Cards;

class FeatureCard
{

	public static function buildData($post_id)
	{

		$data = array();

		$data['image_url'] = get_the_post_thumbnail_url($post_id) ?: null;
		$data['title'] = get_the_title($post_id);
		$data['url'] = get_the_permalink($post_id);
		$data['button_label'] = __('Read', 'ocp');

		return $data;

	}

}
