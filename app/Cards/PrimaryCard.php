<?php

namespace App\Cards;

class PrimaryCard extends BaseCard
{

	public static function convertTimberPost($post) {

		$data = [
			'title' => $post->post_title,
			'url' => $post->link,
			'date' => $post->date,
			'meta' => $post->author ? $post->author->name : null,
			'image_url' => $post->thumbnail ? $post->thumbnail->src : null,
			'type_label' => get_post_type_label($post->post_type),
			'button_label' => __('Read', 'ocp')
		];

		if ( in_array($post->post_type, ['post', 'news']) ) {
			$data['meta'] = $post->date . '<br>' . $data['meta'];
		}

		if ( in_array($post->post_type, ['resource']) ) {
			$data['meta'] = $post->organisation  ?: null;
		}

		if ( $post->post_type === 'post' ) {
			$data['type_label'] = 'Blog';
		}

		if ( $post->post_type === 'news' ) {
			$data['type_label'] = 'News';
		}

		$data['button_label'] = __('Read', 'ocp');

		return $data;

	}

}
