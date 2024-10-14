<?php

namespace App\Cards;

use App\PostTypes\Event;

class PrimaryCard extends BaseCard
{
    public static function convertTimberPost($post)
    {

        $tags = collect($post->tags())
            ->map(function ($tag) {
                return [
                    'name' => $tag->title(),
                    'link' => $tag->link()
                ];
            });

        $data = [
            'title' => $post->post_title,
            'url' => $post->link(),
            'date' => $post->date,
            'meta' => [],
            'image_url' => $post->thumbnail ? $post->thumbnail->src : null,
            'type_label' => get_post_type_label($post->post_type),
            'post_type' => $post->post_type,
            'tags' => $tags,
        ];

        // only posts should have an author
        if ($post->post_type === 'post') {
            if ($post->author && $post->author->name) {
                $data['meta'][] = $post->author->name;
            }
        }

        // posts and news should have a date
        if (in_array($post->post_type, ['post', 'news'])) {
            $data['meta'][] = $post->date;
        }

        // resources should have an organisation if available
        if ($post->post_type === 'resource') {
            if ($post->organisation) {
                $data['meta'][] = $post->organisation;
            }
        }

        if ($post->post_type === 'event') {
            $data['meta'][] = (new Event($post->id))->formattedDate();
        }

        // the meta can always be a br separated string, so make it one now
        // we do this here so to simplify data conditions above

        $data['meta'] = implode('<br>', $data['meta']);

        if ($post->post_type === 'post') {
            $data['type_label'] = 'Blog';
        }

        if ($post->post_type === 'news') {
            $data['type_label'] = 'News';
        }

        return $data;
    }
}
