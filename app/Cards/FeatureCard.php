<?php

namespace App\Cards;

class FeatureCard extends BaseCard
{
    public static function convertTimberPost($post)
    {
        return [
            'image_url' => $post->thumbnail ? $post->thumbnail->src : null,
            'title' => $post->post_title,
            'url' => $post->link(),
            'button_label' => __('Read', 'ocp')
        ];
    }
}
