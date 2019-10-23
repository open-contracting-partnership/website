<?php

namespace App\PostTypes;

use Rareloop\Lumberjack\Post;

class Event extends Post
{
	/**
	 * Return the key used to register the post type with WordPress
	 * First parameter of the `register_post_type` function:
	 * https://codex.wordpress.org/Function_Reference/register_post_type
	 *
	 * @return string
	 */
	public static function getPostType()
	{
		return 'event';
	}

	/**
	 * Return the config to use to register the post type with WordPress
	 * Second parameter of the `register_post_type` function:
	 * https://codex.wordpress.org/Function_Reference/register_post_type
	 *
	 * @return array|null
	 */
	protected static function getPostTypeConfig()
	{
		return [
			'labels' => [
				'name' => __('Events'),
				'singular_name' => __('Event')
			],
			'public' => true,
			'has_archive' => true,
			'rewrite' => ['slug' => 'events', 'with_front' => false],
			'menu_icon' => 'dashicons-calendar',
			'supports' => ['title', 'editor'],
			'show_in_rest' => true
		];
	}
}
