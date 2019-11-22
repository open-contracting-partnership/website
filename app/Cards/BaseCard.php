<?php

namespace App\Cards;

class BaseCard
{

	public static function convertPost($post) {

		if ( is_int($post) ) {
			return static::buildPostById($post);
		} else if ( is_object($post) && get_class($post) === 'WP_Post' ) {
			return static::buildPostById($post->ID);
		} else if ( is_object($post) && ( get_class($post) === 'Timber\Post' || is_subclass_of($post, 'Timber\Post') ) ) {
			return static::convertTimberPost($post);
		} else if ( method_exists(static::class, 'buildData') ) {
			return static::buildData($post);
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
