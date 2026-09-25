<?php

namespace App\Cards;

class EventCard extends BaseCard
{
    public static function convertTimberPost($post): array
    {
        $date = $post->event_date ? strtotime($post->event_date) : null;

        return [
            'title' => $post->post_title,
            'url' => $post->link(),
            'day' => $date ? date('j', $date) : '',
            'month' => $date ? date('M', $date) : ''
        ];
    }
}
