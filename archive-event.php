<?php

namespace App;

use App\Cards\EventCard;
use App\Http\Controllers\Controller;
use App\PostTypes\Event;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class ArchiveEventController extends Controller
{
	public function handle()
	{
		$context = Timber::get_context();
		$context['title'] = get_post_type_label('event', true);
		$context['latest_event'] = null;

		$upcoming_events = Event::query([
			'post_type' => 'event',
			'posts_per_page' => -1,
			'meta_key' => 'event_date',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
			'meta_query' => [[
				'key' => 'event_date',
				'value' => date('Ymd'),
				'compare' => '>=',
			]]
		]);

		if ( isset($upcoming_events[0]) ) {
			$context['latest_event'] = Event::convertTimberObject($upcoming_events[0]);
		}

		$context['upcoming_events'] = EventCard::convertCollection($upcoming_events);

		$archive_events = Event::query([
			'post_type' => 'event',
			'posts_per_page' => 3,
			'meta_key' => 'event_date',
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			'meta_query' => [[
				'key' => 'event_date',
				'value' => date('Ymd'),
				'compare' => '<',
			]]
		]);

		$context['archive_events'] = EventCard::convertCollection($archive_events);

		$context['events']['i18n']['introduction'] = _x(
			'Open contracting events around the world. Are you hosting an event? Let us know and we\'ll be happy to share here.',
			'The events introduction',
			'ocp'
		);

		$context['events']['i18n']['upcoming_events_label'] = _x(
			'Upcoming events',
			'The upcoming events label for the events archive',
			'ocp'
		);

		$context['events']['i18n']['past_events_label'] = _x(
			'View past events',
			'The past events label for the events archive',
			'ocp'
		);

		return new TimberResponse('templates/archive-event.twig', $context);
	}
}
