<?php

namespace App\Cards;

use Timber\Post;

class BaseCard
{

	/**
	 * convert the incoming post object to one formatted specifically for the
	 * card that extends this class
	 * @param  int/WP_Post/TimberPost $post the incoming post data
	 * @return array the post data array
	 */
	public static function convertPost($post) {

		// idealy we'd like to only convert one data type, if the incoming data
		// is an ID or WP_Post object, convert it to a Timber\Post so we can
		// focus all of the converting in just on area

		if ( is_int($post) || (is_object($post) && get_class($post) === 'WP_Post') ) {
			$post = new Post($post);
		}

		if ( is_object($post) && ( get_class($post) === 'Timber\Post' || is_subclass_of($post, 'Timber\Post') ) ) {
			return static::convertTimberPost($post);
		}

	}

	public static function convertCollection($collection, $callback = null) {

		$collection = array_map(function($post) {
			return self::convertPost($post);
		}, self::convertCollectionToArray($collection));

		if ( is_callable($callback) ) {

			foreach ( $collection as &$item ) {
				$item = $callback($item);
			}

		}

		return $collection;

	}

	public static function convertCollectionToArray($collection) {

		if ( is_array($collection) ) {
			return $collection;
		}

		$items = [];

		foreach ( $collection as $item ) {
			$items[] = $item;
		}

		return $items;

	}

}
