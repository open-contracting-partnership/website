<?php

namespace App\Cards;

class EventCard extends BaseCard
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
			'url' => $post->link(),
			'day' => date('j', strtotime($post->event_date)),
			'month' => date('M', strtotime($post->event_date))
		];

	}

}
