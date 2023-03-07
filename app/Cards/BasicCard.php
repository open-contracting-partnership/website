<?php

namespace App\Cards;

class BasicCard extends BaseCard
{
    public static function convertTimberPost($post)
    {
        return [
            'title' => $post->post_title,
            'url' => $post->link(),
            'meta' => $post->date('j M Y'),
            'type' => $post->post_type,
            'type_label' => get_post_type_label($post->post_type)
        ];
    }
}
