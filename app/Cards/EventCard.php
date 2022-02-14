<?php

namespace App\Cards;

class EventCard extends BaseCard
{

    public static function convertTimberPost($post)
    {

        return [
            'title' => $post->post_title,
            'url' => $post->link(),
            'day' => date('j', strtotime($post->event_date)),
            'month' => date('M', strtotime($post->event_date))
        ];
    }
}
