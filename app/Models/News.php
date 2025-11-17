<?php

namespace App\Models;

use App\Cards\PrimaryCard;
use App\Providers\ImgixServiceProvider;
use Imgix\UrlBuilder;
use Rareloop\Lumberjack\Facades\Config;
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
            if (! isset($new['image_url'])) {
                $new['image_url'] = '/themes/ocp-v1/resources/img/fallback-v2.jpg';
            }

            $new['imageSrc'] = self::imgixImages($new['image_url'], [
                'auto' => 'format',
                'fit' => 'crop',
                'w' => 415,
                'h' => 234,
            ]);

            $new['imageSrcset'] = collect([
                [415, 234],
                [830, 467],
                [1024, 576],
                [1536, 864],
                [2048, 1152],
            ])
                ->map(function ($size) use ($new) {
                    return self::imgixImages($new['image_url'], [
                        'auto' => 'format',
                        'fit' => 'crop',
                        'w' => $size[0],
                        'h' => $size[1],
                    ]) . " {$size[0]}w";
                })
                ->join(', ');

            $new['issues'] = collect($original->terms('issue') ?: [])
                ->pluck('slug')
                ->toArray();

            return $new;
        });

        return $posts;
    }

    protected static function imgixImages(string $imageUrl, ?array $params = []): string
    {
        $imageUrl = ImgixServiceProvider::processUrl($imageUrl);

        $builder = new UrlBuilder(Config::get('images.imgix_domain'));
        $builder->setSignKey(Config::get('images.imgix_signing_key'));

        return $builder->createURL($imageUrl, $params);
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
