<?php // archive-event.php ?>

<?php get_header(); ?>

	<?php

		$events = vue_posts([
			'query' => array(
				'post_type' => 'event',
				'posts_per_page' => -1,
				'meta_key'   => 'event_date',
				'orderby'    => 'meta_value_num',
				'order'      => 'DESC'
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
				}
			)
		]);

	?>

	<div id="events" class="events-overview / wrapper archive--padding">

		<div class="archive-content">
			<h1><?php pll_e('Events'); ?></h1>
			<p class="strapline strapline--blue"><?php pll_e('Our multi-stakeholder advisory board is made up of renowned individuals from across government, the private sector, civil society, the technology sector and development organisations. It meets twice a year and on a regular basis in its subcommittees.'); ?></p>
		</div>

		<div class="archive-content__posts">

			<div v-if="events.length">

				<div
					v-for="event in events"
					class="post-object post-object--event post-object--event-clickable"
					v-bind:class="{ 'active': open_event === event }"
					v-on:click="openEvent(event, $event)"
				>
					<event :event="event"></event>
				</div>

			</div>

			<p v-else><?php pll_e('No upcoming events'); ?></p>

		</div>

		<div class="archive-event__view">

			<div class="open-event" v-if="open_event !== null">

				<div class="event__title">
					<svg><use xlink:href="#icon-event" /></svg>
					<time v-if="open_event.custom.has_date">{{ open_event.custom.day }}<span>{{ open_event.custom.suffix }}</span> {{ open_event.custom.long_month }} {{ open_event.custom.year }}</time>
					<time v-else><span><?php pll_e('To Be Announced'); ?></span></time>
				</div>

				<h1 class="gamma">{{{ open_event.title }}}</h1>

				<p class="event__meta">
					<?php pll_e('Organisation'); ?>: {{ open_event.fields.organisation }}<span v-if="open_event.fields.event_location">, {{{ open_event.fields.event_location }}}</span>
				</p>

				<hr>

				<div class="post-content">

					{{{ open_event.content }}}

					<p v-if="open_event.fields.link">
						<a href="{{ open_event.fields.link }}"><?php pll_e('View more details'); ?></a>
					</p>

				</div>

				<hr>

				<div class="band band--extra-thick">

					<div v-if="hasTerms(open_event.taxonomies['region'])" class="event__terms">

						<span><?php pll_e('Location'); ?>:</span>

						<ul class="button__list">
							<li v-for="region in open_event.taxonomies['region']"><a href="/region/{{ $key }}" class="button button--small button--tag">{{{ region }}}</a></li>
						</ul>

					</div>

					<div v-if="hasTerms(open_event.taxonomies['issue'])" class="event__terms">

						<span><?php pll_e('Issue'); ?>:</span>

						<ul class="button__list">
							<li v-for="issue in open_event.taxonomies['issue']"><a href="/issue/{{ $key }}" class="button button--small button--tag">{{{ issue }}}</a></li>
						</ul>

					</div>

					<div v-if="hasTerms(open_event.taxonomies['audience'])" class="event__terms">

						<span><?php pll_e('Audience'); ?>:</span>

						<ul class="button__list">
							<li v-for="audience in open_event.taxonomies['audience']"><a href="/audience/{{ $key }}" class="button button--small button--tag">{{{ audience }}}</a></li>
						</ul>

					</div>

					<div v-if="hasTerms(open_event.taxonomies['open-contracting'])" class="event__terms">

						<span><?php pll_e('OC Framework'); ?>:</span>

						<ul class="button__list">
							<li v-for="open_contracting in open_event.taxonomies['open-contracting']"><a href="/open-contracting/{{ $key }}" class="button button--small button--tag">{{{ open_contracting }}}</a></li>
						</ul>

					</div>

					<hr>

					<div v-if="open_event.fields.attachments" class="event__terms">

						<p><?php pll_e('Attachments'); ?></p>

						<ul class="arrow-list">
							<li v-for="attachment in open_event.fields.attachments"><a href="{{ attachment.file }}">{{{ attachment.name }}}</a></li>
						</ul>

					</div>

				</div>

			</div> <!-- / .event -->

			<template id="event-template">

				<div class="post-object__media">
					<time v-if="event.custom.has_date">{{ event.custom.day }}<span>{{ event.custom.suffix }}</span><em>{{ event.custom.month }}</em></time>
					<em v-else>TBA</em>
				</div>

				<div class="post-object__content">
					<h4>{{{ event.title }}}</h4>
				</div>

				<div class="post-object__link">
					<a href="{{ event.link }}"><?php pll_e('Details'); ?></a>
				</div>

			</template>

			<script src="https://cdn.jsdelivr.net/vue/latest/vue.js"></script>

			<script>

				// register the grid component
				Vue.component('event', {
					template: '#event-template',
					props: {
						event: Object
					}
				});

				var event_vue = new Vue({

					el: '#events',

					data: {
						// data
						events: <?php echo json_encode($events); ?>,
						// open event
						open_event: null
					},

					methods: {

						hasTerms: function(taxonomy) {
							return Object.keys(taxonomy).length > 0;
						},

						openEvent: function(selected_event, event) {

							var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

							if ( width > 1100 ) {
								event.preventDefault();
								this.open_event = selected_event;
							}

						}

					}

				});

				event_vue.open_event = event_vue.events[0];

			</script>

		</div>

	</div>

<?php get_footer(); ?>
