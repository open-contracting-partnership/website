<?php

namespace App\PostTypes;

use Rareloop\Lumberjack\Post;

class Resource extends Post
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
		return 'resource';
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
				'name' => __('Resources'),
				'singular_name' => __('Resource')
			],
			'public' => true,
			'has_archive' => true,
			'rewrite' => ['slug' => 'resources', 'with_front' => false],
			'menu_icon' => 'dashicons-book-alt',
			'supports' => ['title', 'editor', 'thumbnail'],
			'show_in_rest' => true
		];
	}
}
