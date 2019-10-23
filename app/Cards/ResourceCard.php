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

}
