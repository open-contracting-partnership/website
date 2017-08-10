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

	?>

	<div id="events" v-cloak class="events-overview / page__wrapper">

		<div class="page-title">

			<h1><?php _e('Events', 'ocp'); ?></h1>

			<?php if ( $introduction = get_field('event_introduction', 'options') ) : ?>
				<h2 class="strapline delta"><?php echo $introduction; ?></h2>
			<?php endif; ?>

		</div>

		<div class="archive-content__posts">

			<div v-if="events.length">

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

		</div>

		<div class="archive-event__view">

			<div class="open-event" v-if="open_event !== null">

				<div class="event__title {{ ! open_event.custom.is_future ? 'event__title--past' : '' }}">
					<svg><use xlink:href="#icon-event" /></svg>
					<time v-if="open_event.custom.has_date">{{ open_event.custom.day }} {{ open_event.custom.long_month }} {{ open_event.custom.year }}</time>
					<time v-else><span><?php _e('To Be Announced', 'ocp'); ?></span></time>
				</div>

				<h1 class="gamma">{{{ open_event.title }}}</h1>

				<p class="event__meta">
					<?php _e('Organisation', 'ocp'); ?>: {{ open_event.fields.organisation }}<span v-if="open_event.fields.event_location">, {{{ open_event.fields.event_location }}}</span>
				</p>

				<hr>

				<div class="post-content">

					{{{ open_event.content }}}

					<p v-if="open_event.fields.link">
						<a href="{{ open_event.fields.link }}"><?php _e('View more details', 'ocp'); ?></a>
					</p>

				</div>

				<div class="band band--extra-thick">

					<div v-if="hasTerms(open_event.taxonomies['region'])" class="event__terms">

						<span><?php _e('Location', 'ocp'); ?>:</span>

						<a href="/region/{{ $key }}" v-for="region in open_event.taxonomies['region']">{{{ region }}}</a>

					</div>

					<div v-if="hasTerms(open_event.taxonomies['issue'])" class="event__terms">

						<span><?php _e('Issue', 'ocp'); ?>:</span>

						<a href="/issue/{{ $key }}" v-for="issue in open_event.taxonomies['issue']">{{{ issue }}}</a>

					</div>

					<div v-if="hasTerms(open_event.taxonomies['audience'])" class="event__terms">

						<span><?php _e('Audience', 'ocp'); ?>:</span>

						<a href="/audience/{{ $key }}" v-for="audience in open_event.taxonomies['audience']">{{{ audience }}}</a>

					</div>

					<div v-if="hasTerms(open_event.taxonomies['open-contracting'])" class="event__terms">

						<span><?php _e('OC Framework', 'ocp'); ?>:</span>

						<a href="/open-contracting/{{ $key }}" v-for="open_contracting in open_event.taxonomies['open-contracting']">{{{ open_contracting }}}</a>

					</div>

					<div v-if="open_event.fields.attachments" class="event__terms">

						<p><?php _e('Attachments', 'ocp'); ?></p>

						<ul class="arrow-list">
							<li v-for="attachment in open_event.fields.attachments"><a href="{{ attachment.file }}">{{{ attachment.name }}}</a></li>
						</ul>

					</div>

				</div>

			</div> <!-- / .event -->

			<script type="x/templates" id="event-template">

				<a href="{{event.link}}" class="card card--event">

				    <div class="card-event__date">
				        <span class="card-event__day">{{ event.custom.day }}</span>
				        <span class="card-event__month">{{ event.custom.month }}</span>
				    </div>

				    <div class="card__content">
				        <h6 class="card__heading">{{{ event.title }}}</h6>
				    </div>

				</a>

			</script>

			<script>

				// register the grid component
				Vue.component('event', {
					template: '#event-template',
					props: {
						event: Object
					}
				});

				// allows v-for to pipe reverse
				Vue.filter('reverse', function(value) {
					// slice to make a copy of array, then reverse the copy
					return value.slice().reverse();
				});

				var event_vue = new Vue({

					el: '#events',

					data: {
						// data
						events: <?php echo json_encode($events); ?>,
						// open event
						open_event: null,
						show_archived: false
					},

					computed: {

						futureEvents: function() {
							return this.getEvents();
						},

						pastEvents: function() {
							return this.getEvents(false).reverse();
						}

					},

					methods: {

						getEvents: function(is_future) {

							is_future = typeof is_future === 'undefined' ? true : is_future;

							var events = [];

							this.events.forEach(function(event) {

								if ( event.custom.is_future === is_future ) {
									events.push(event);
								}

							});

							return events;

						},

						hasTerms: function(taxonomy) {
							return Object.keys(taxonomy).length > 0;
						},

						openEvent: function(selected_event, event) {

							var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

							if ( width >= 768 ) {

								event.preventDefault();
								this.open_event = selected_event;

								history.pushState({event_id: selected_event.id}, null, '#' + selected_event.slug);

							}

						}

					}

				});


				// check for a hash
				// open appropriate event

				var current_event = event_vue.futureEvents[0];

				var event_index = 0;

				if ( location.hash ) {

					event_vue.events.forEach(function(event, index) {

						if ( '#' + event.slug === location.hash ) {
							event_index = index;
						}

					});

				}

				if ( event_index !== 0 ) {
					event_vue.open_event = event_vue.events[event_index];
				} else {
					event_vue.open_event = current_event;
				}

				window.addEventListener('popstate', function(event) {

					if ( event.state && typeof event.state.event_id !== 'undefined' ) {

						// filter the events to match by id
						var result = $.grep(event_vue.events, function(e){ return e.id == event.state.event_id; });

						// if an event is returned, set the open event
						if ( result.length ) {
							event_vue.open_event = result[0];
						}

					}

				});

			</script>

		</div>

	</div>

<?php get_footer(); ?>
