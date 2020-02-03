<?php

namespace App\PostTypes;

use Rareloop\Lumberjack\Post;

class News extends Post
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
		return 'news';
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
				'name' => _x('News', 'News custom post type (plural)', 'ocp'),
				'singular_name' => _x('News', 'News custom post type (singular)', 'ocp'),
			],
			'public' => true,
			'has_archive' => true,
			'rewrite' => ['with_front' => false],
			'menu_position' => 5,
			'menu_icon' => 'dashicons-welcome-write-blog',
			'supports' => ['title', 'editor'],
			'show_in_rest' => true
		];
	}
}
