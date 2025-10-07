<?php

namespace App\Models;

use App\Cards\PrimaryCard;
use Timber\Timber;

class News
{
    public static function getPosts()
    {
        $posts = Timber::get_posts([
            'post_type' => ['post', 'news'],
            'posts_per_page' => -1,
        ]);

        $posts = PrimaryCard::convertCollection($posts, function ($new, $original) {
            $new['issues'] = collect($original->terms('issue') ?: [])
                ->pluck('slug')
                ->toArray();

            return $new;
        });

        return $posts;
    }

    public static function getFilters(): array
    {
        return collect(get_terms([
            'taxonomy' => 'issue',
        ]))
            ->map(function ($term) {
                return [
                    'id' => $term->term_id,
                    'name' => $term->name,
                    'slug' => $term->slug,
                ];
            })
            ->values()
            ->toArray();
    }
}
