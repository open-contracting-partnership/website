<?php

namespace App\Cards;

class CarouselCard
{

    public static function convertTimberPost($post)
    {

        return [
            'title' => $post->post_title,
            'introduction' => $post->excerpt,
            'image' => $post->thumbnail->src,
            'url' => $post->link()
        ];
    }
}
