<?php

namespace App\Cards;

class BaseCard
{

	public static function convertPost($post) {

		if ( is_int($post) ) {
			return static::buildPostById($post);
		}

		if ( is_object($post) && get_class($post) === 'WP_Post' ) {
			return static::buildPostById($post->ID);
		}

		// if ( is_object($post) && get_class($post) === 'Timber\Post' ) {
		if ( is_object($post) && is_subclass_of($post, 'Timber\Post') ) {
			return static::convertTimberPost($post);
		}

	}

	public static function convertCollection($collection) {

		return array_map(function($post) {
			return self::convertPost($post);
		}, self::convertCollectionToArray($collection));

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
