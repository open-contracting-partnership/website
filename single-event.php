<?php

/**
 * The Template for displaying all single posts
 */

namespace App;

use App\Http\Controllers\Controller;
use App\PostTypes\Event;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class SingleEventController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $event = new Event();

        $context['event'] = Event::convertTimberObject($event);

        $context['back_link'] = [
            'url' => get_post_type_archive_link('event'),
            'label' => __('Back to events', 'ocp')
        ];

        return new TimberResponse('templates/single-event.twig', $context);
    }
}
