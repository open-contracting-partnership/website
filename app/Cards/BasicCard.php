<?php

namespace App\Cards;

use App\PostTypes\Event;

class BasicCard extends BaseCard
{
    public static function convertTimberPost($post): array
    {
        $data = [
            'title' => $post->post_title,
            'url' => $post->link(),
            'meta' => $post->date('j M Y'),
            'type' => $post->post_type,
            'type_label' => get_post_type_label($post->post_type),
            'excerpt' => $post->post_excerpt,
            'show_excerpt' => false,
        ];

        if ($post->post_type === 'event') {
            $data['meta'] = (new Event($post->id))->formattedDate();
        }

        return $data;
    }
}
