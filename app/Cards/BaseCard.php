<?php

namespace App\Cards;

use Timber\Post;
use WP_Post;

class BaseCard
{
    /**
     * convert the incoming post object to one formatted specifically for the
     * card that extends this class
     */
    public static function convertPost(int|Post|WP_Post $post): array
    {
        // idealy we'd like to only convert one data type, if the incoming data
        // is an ID or WP_Post object, convert it to a Timber\Post so we can
        // focus all of the converting in just on area

        if (is_int($post) || (is_object($post) && get_class($post) === 'WP_Post')) {
            $post = new Post($post);
        }

        if (is_object($post) && ( get_class($post) === 'Timber\Post' || is_subclass_of($post, 'Timber\Post') )) {
            return static::convertTimberPost($post);
        }

        return [];
    }

    public static function convertTimberPost($post): array
    {
        return [];
    }

    public static function convertCollection($collection, $callback = null)
    {
        $collection = self::convertCollectionToArray($collection);

        foreach ($collection as $key => &$original) {
            $new = self::convertPost($original);

            if (is_callable($callback)) {
                $new = $callback($new, $original, $key);
            }

            // update the original item with the new
            $original = $new;
        }

        return $collection;
    }

    public static function convertCollectionToArray($collection)
    {
        if (is_array($collection)) {
            return $collection;
        }

        $items = [];

        foreach ($collection as $item) {
            $items[] = $item;
        }

        return $items;
    }
}
