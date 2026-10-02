<?php

namespace App\Cards;

use Timber\Post;
use Timber\Timber;
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
            $post = Timber::get_post($post);
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

    /**
     * Return the cached result of $build, per language, until any post, term or user changes.
     *
     * Rendering content enqueues the styles and scripts of its blocks,
     * so a cached result re-enqueues those that $build enqueued.
     */
    public static function remember(string $key, callable $build)
    {
        $key = implode(':', [
            $key,
            apply_filters('wpml_current_language', null),
            wp_cache_get_last_changed('posts'),
            wp_cache_get_last_changed('terms'),
            wp_cache_get_last_changed('users'),
        ]);

        $cached = wp_cache_get($key, 'ocp_cards', false, $found);

        if ($found) {
            array_map('wp_enqueue_style', $cached['styles']);
            array_map('wp_enqueue_script', $cached['scripts']);
        } else {
            $styles = wp_styles()->queue;
            $scripts = wp_scripts()->queue;

            $cached = [
                'value' => $build(),
                'styles' => array_values(array_diff(wp_styles()->queue, $styles)),
                'scripts' => array_values(array_diff(wp_scripts()->queue, $scripts)),
            ];

            wp_cache_set($key, $cached, 'ocp_cards', DAY_IN_SECONDS);
        }

        return $cached['value'];
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
