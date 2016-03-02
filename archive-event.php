<?php // archive-event.php ?>

<?php get_header(); ?>

	<?php

		$events = vue_posts([
			'query' => array(
				'post_type' => 'event',
				'posts_per_page' => -1
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

	<div id="events" class="resources-overview events-overview / wrapper archive--padding">

		<div class="archive-content">

			<h1><?php the_post_type_label(NULL, TRUE); ?></h1>

			<p class="strapline strapline--blue">Our multi-stakeholder advisory board is made up of renowned individuals from across government, the private sector, civil society, the technology sector and development organisations. It meets twice a year and on a regular basis in its subcommittees.</p>

		</div>

		<div class="archive-content__posts">

			<div v-if="events.length">

				<div v-for="event in events" class="post-object post-object--event" v-on:click="openEvent(event, $event)">
					<event :event="event"></event>
				</div>

			</div>

			<p v-else><?php pll_e('No upcoming events'); ?></p>

		</div>

		<div class="archive-event__view">

			<div class="event__overlay" v-if="open_event !== null" v-on:click.prevent="open_event = null"></div>

			<div class="open-event" v-if="open_event !== null">

				<div class="event__title">
					<svg><use xlink:href="#icon-event" /></svg>
					<time v-if="open_event.custom.has_date">{{ open_event.custom.day }}<span>{{ open_event.custom.suffix }}</span> {{ open_event.custom.long_month }} {{ open_event.custom.year }}</time>
					<time v-else><span>To Be Announced</span></time>
				</div>

				<h1 class="gamma">{{{ open_event.title }}}</h1>

				<p class="event__meta">
					Organisation: {{ open_event.fields.organisation }}<span v-if="open_event.fields.event_location">, {{{ open_event.fields.event_location }}}</span>
				</p>

				<p v-if="open_event.fields.attachments">
					<a onclick="_gaq.push(['_trackEvent', 'Resources', 'Download', '{{{ open_event.title }}}']);" href="{{ open_event.fields.attachments[0].file }}" class="button button--block button--large button--icon button--icon--reverse button--icon--stroke">Download<svg><use xlink:href="#icon-download" /></svg></a>
				</p>

				<p v-if="open_event.fields.link">
					<a onclick="_gaq.push(['_trackEvent', 'Resources', 'Visit', '{{{ open_event.title }}}']);" href="{{ open_event.fields.link }}" class="button button--block button--large">View</a>
				</p>

				<hr />

				<div class="post-content">
					{{{ open_event.content }}}
				</div>

				<hr />

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
					<a href="{{ event.link }}">Details</a>
				</div>

			</template>

			<script src="https://cdn.jsdelivr.net/vue/latest/vue.js"></script>

			<script>

				// register the grid component
				Vue.component('event', {
					template: '#event-template',
					props: {
						event: Object
					},
					methods: {

						taxonomyLabels: function(taxonomy) {
							return objectValues(this.event.taxonomies[taxonomy]);
						}

					}
				});

				function objectValues(object) {

					var array = [];

					Object.keys(object).forEach(function (key) {
						array.push(object[key]);
					});

					return array;

				}

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

						openEvent: function(Event, event) {

							var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

							if ( width > 810 ) {

								// set post object as variable
								$this = $(event.target).hasClass('.post-object') ? $(event.target) : $(event.target).closest('.post-object');

								if ( ! $this.hasClass('active') ) {
									$('.post-object.active').removeClass('active');
									$this.addClass('active');
								}

								event.preventDefault();

								this.open_event = Event;

							}

						}

					},

				});

			</script>

		</div>

	</div>

<?php get_footer(); ?>
