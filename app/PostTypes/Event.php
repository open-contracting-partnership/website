<?php

namespace App\PostTypes;

use ImLiam\ShareableLink;
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
				'name' => _x('Events', 'Event custom post type (plural)', 'ocp'),
				'singular_name' => _x('Event', 'Event custom post type (singular)', 'ocp'),
			],
			'public' => true,
			'has_archive' => true,
			'rewrite' => ['slug' => 'events', 'with_front' => false],
			'menu_icon' => 'dashicons-calendar',
			'supports' => ['title', 'editor'],
			'show_in_rest' => true
		];
	}

	public static function convertTimberObject($event) {

		$context = array();

		$context['title'] = $event->title;
		$context['date'] = date('j M Y', strtotime($event->event_date));
		$context['location'] = $event->event_location;
		$context['link'] = $event->link;
		$context['link_text'] = $event->link_text;
		$context['content'] = $event->content;
		$context['organisation'] = $event->organisation;

		// terms
		$context['taxonomies']['region'] = $event->region;
		$context['taxonomies']['audience'] = $event->audience;
		// $context['taxonomies']['issue'] = $event->issue;
		// $context['taxonomies']['country'] = $event->country;
		// $context['taxonomies']['open_contracting'] = $event->open_contracting;

		// for each of the taxonomies, convert the term id to a term object
		foreach ( $context['taxonomies'] as &$taxonomy ) {

			if ( ! is_array($taxonomy) ) {
				continue;
			}

			$taxonomy = array_map(function($term) {
				return get_term($term);
			}, $taxonomy);

		}

		$share_links = new ShareableLink($event->link(), $event->title);

		$context['share_links'] = array(
			'twitter' => $share_links->twitter,
			'facebook' => $share_links->facebook,
			'linkedin' => $share_links->linkedin
		);

		return $context;

	}
}
