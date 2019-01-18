<?php // archive-event.php ?>

<?php get_header(); ?>

	<?php

		$events = vue_posts([
			'query' => array(
				'post_type' => 'event',
				'posts_per_page' => -1,
				'meta_key'   => 'event_date',
				'orderby'    => 'meta_value_num',
				'order'      => 'ASC'
			),
			'taxonomies' => ['audience', 'region', 'country', 'issue', 'open-contracting'],
			'fields' => ['event_date', 'event_location', 'organisation', 'attachments', 'link'],
			'custom' => array(
				'has_date' => function($vue_post) {
					return get_field('event_date', $vue_post);
				},
				'day' => function($vue_post) {
					return date('j', strtotime(get_field('event_date', $vue_post)));
				},
				'suffix' => function($vue_post) {
					return date('S', strtotime(get_field('event_date', $vue_post)));
				},
				'month' => function($vue_post) {
					return date('M', strtotime(get_field('event_date', $vue_post)));
				},
				'long_month' => function($vue_post) {
					return date('F', strtotime(get_field('event_date', $vue_post)));
				},
				'year' => function($vue_post) {
					return date('Y', strtotime(get_field('event_date', $vue_post)));
				},
				'is_future' => function($vue_post) {
					// checking against d-m-Y for an event starting today
					$current_date = strtotime(date('d-m-Y'));
					$event_date = strtotime(get_field('event_date', $vue_post));
					return $current_date <= $event_date;
				}
			)
		]);

		wp_localize_script('events', 'content', [
			'events' => $events
		]);

	?>

	<div id="events" v-cloak class="events-overview / page__wrapper">

		<div class="page-title">

			<h1><?php _e('Events', 'ocp'); ?></h1>

			<?php if ( $introduction = get_field('event_introduction', 'options') ) : ?>
				<h2 class="strapline delta"><?php echo $introduction; ?></h2>
			<?php endif; ?>

		</div>

		<div class="archive-content__posts" v-if="events.length">

			<h5 class="future-events">Upcoming events</h5>

			<div class="archive-content__future-events">
				<div
					v-for="event in futureEvents"
					class="post-object post-object--event post-object--event-future post-object--event-clickable"
					v-bind:class="{ 'active': open_event === event }"
					v-on:click="openEvent(event, $event)"
				>
					<event :event="event"></event>
				</div>
			</div>

			<span
				class="archive-content__more"
				v-if="!show_archived"
				v-on:click="show_archived = true"
			>View archived</span>

			<span
				class="archive-content__more"
				v-if="show_archived"
				v-on:click="show_archived = false"
			>Hide archived</span>

			<div
				v-for="event in pastEvents"
				class="post-object post-object--event post-object--event-past post-object--event-clickable"
				v-bind:class="{ 'active': open_event === event }"
				v-on:click="openEvent(event, $event)"
				v-show="show_archived"
			>
				<event :event="event"></event>
			</div>

		</div>

		<p v-else><?php _e('No upcoming events', 'ocp'); ?></p>

		<div class="archive-event__view">

			<div class="open-event" v-if="open_event !== null">

				<div class="event__title" v-bind:class="{ 'event__title--past': ! open_event.custom.is_future }">
					<svg><use xlink:href="#icon-event" /></svg>
					<time v-if="open_event.custom.has_date">{{ open_event.custom.day }} {{ open_event.custom.long_month }} {{ open_event.custom.year }}</time>
					<time v-else><span><?php _e('To Be Announced', 'ocp'); ?></span></time>
				</div>

				<h1 class="gamma" v-html="open_event.title"></h1>

				<p class="event__meta">
					<?php _e('Organisation', 'ocp'); ?>: {{ open_event.fields.organisation }}<span v-if="open_event.fields.event_location">, <span v-html="open_event.fields.event_location"></span></span>
				</p>

				<hr>

				<div class="post-content">

					<div v-html="open_event.content"></div>

					<p v-if="open_event.fields.link">
						<a :href="open_event.fields.link"><?php _e('View more details', 'ocp'); ?></a>
					</p>

				</div>

				<div class="band band--extra-thick">

					<div v-if="hasTerms(open_event.taxonomies['region'])" class="event__terms">

						<span><?php _e('Location', 'ocp'); ?>:</span>

						<a :href="'/region/' + index" v-for="(region, index) in open_event.taxonomies['region']" v-html="region"></a>

					</div>

					<div v-if="hasTerms(open_event.taxonomies['issue'])" class="event__terms">

						<span><?php _e('Issue', 'ocp'); ?>:</span>

						<a :href="'/issue/' + index" v-for="(issue, index) in open_event.taxonomies['issue']" v-html="issue"></a>

					</div>

					<div v-if="hasTerms(open_event.taxonomies['audience'])" class="event__terms">

						<span><?php _e('Audience', 'ocp'); ?>:</span>

						<a :href="'/audience/' + index" v-for="(audience, index) in open_event.taxonomies['audience']" v-html="audience"></a>

					</div>

					<div v-if="hasTerms(open_event.taxonomies['open-contracting'])" class="event__terms">

						<span><?php _e('OC Framework', 'ocp'); ?>:</span>

						<a :href="'/open-contracting/' + index" v-for="(open_contracting, index) in open_event.taxonomies['open-contracting']" v-html="open_contracting"></a>

					</div>

					<div v-if="open_event.fields.attachments" class="event__terms">

						<p><?php _e('Attachments', 'ocp'); ?></p>

						<ul class="arrow-list">
							<li v-for="attachment in open_event.fields.attachments"><a :href="attachment.file" v-html="attachment.name"></a></li>
						</ul>

					</div>

				</div>

			</div> <!-- / .event -->

		</div>

	</div>

<?php get_footer(); ?>
