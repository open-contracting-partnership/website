<?php

namespace App\PostTypes;

use App\Cards\ResourceCard;
use Rareloop\Lumberjack\Post;
use Timber\Term;
use Timber\Timber;

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
                'name' => _x('Resources', 'Resources custom post type (plural)', 'ocp'),
                'singular_name' => _x('Resource', 'Resource custom post type (singular)', 'ocp')
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'resources', 'with_front' => false],
            'menu_icon' => 'dashicons-book-alt',
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true
        ];
    }

    public function image()
    {
        return $this->thumbnail() ? $this->thumbnail()->src : null;
    }

    public function resourceType()
    {
        return $this->meta('resource_type') ?: null;
    }

    public function colour(): string
    {
        $colour = 'black';

        // it doesn't matter if the type is truthy, it must be an instance of
        // Timber\Term to have a colour

        if ($this->resourceType() instanceof Term && isset($this->resourceType()->colour)) {
            $colour = $this->resourceType()->colour;
        }

        return $colour;
    }

    public function fallbackImageType(): string
    {
        return match ($this->resourceType?->slug) {
            'data-tool' => 'data',
            'infographic' => 'infographic',
            default => 'resource',
        };
    }

    public static function getAllResources(): array
    {
        $resources = Resource::query([
            'posts_per_page' => -1
        ]);

        $resources = ResourceCard::convertCollection($resources, function ($new, $original) {
            return [
                'title' => $new['title'],
                'date' => $new['date'],
                'is_featured' => $new['is_featured'],
                'type' => $new['type'],

                // new card output
                'card' => Timber::compile('cards/resource.twig', [
                    'card' => $new,
                ])
            ];
        });

        return $resources;
    }
}
