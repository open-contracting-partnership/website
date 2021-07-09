<?php

namespace App\Cards;

class ResourceCard extends BaseCard
{

    public static function convertTimberPost($post)
    {
        $meta = null;

        if ($post->event_date) {
            $meta = \DateTime::createFromFormat('Ymd', $post->event_date)->format('j M Y');
        }

        return [
            'title' => $post->post_title,
            'url' => $post->link(),
            'meta' => $meta,
            'type' => $post->post_type,
            'type_label' => get_post_type_label($post->post_type)
        ];
    }
}
