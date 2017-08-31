<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="page__wrapper" id="impact-stories">

		<?php get_partial('page', 'title'); ?>

		<div class="card card--featured">

			<img class="card__featured-media" v-bind:src="stories[0].image.url">

			<div class="card__content">

				<div class="card__title">
					<h6 class="card__heading">{{ stories[0].title }}</h6>
				</div>

				<p class="card__meta">{{ stories[0].introduction }}</p>
				<a class="button button--white" href="{{ stories[0].link }}">{{ stories[0].link_text }}</a>

			</div>

		</div>

		<article class="page-content cf">

			<aside class="impact-stores__sidebar">

				<h3>Filter Search</h3>

				<div>

					<h2>Story Type</h2>

					<label v-for="type in types[0]">
						<input type="checkbox" value="{{ type.slug }}" v-model="filters">
						{{ type.name }}
					</label>

				</div>

				<div>

					<h2>Country</h2>

					<label v-for="country in countries[0]">
						<input type="checkbox" value="{{ country.slug }}" v-model="filters">
						{{ country.name }}
					</label>

				</div>

			</aside>

			<section class="impact-stories__main">

				<div v-for="story in getStories">
					<story :story="story"></story>
				</div>

			</section>

		</article>

	</div> <!-- / .page__wrapper -->

	<script type="x/templates" id="story-template">

		<div class="card card--primary">

			<div class="card__header">
				<img class="card__featured-media" v-bind:src="story.image.sizes['16x9_690']">
			</div>

			<div class="card__content">

				<div class="card__title">
					<h6 class="card__heading">{{ story.title }}</h6>
				</div>

				<p class="card__meta">{{ story.introduction }}</p>
				<a class="card__link text-button button--icon" href="{{ story.link }}">{{ story.link_text }} <svg><use xlink:href="#icon-arrow-right" /></svg></a>

			</div>

		</div>

	</script>

	<script>

		// register the grid component
		Vue.component('story', {
			template: '#story-template',
			props: {
				story: Object
			}
		});

		var impact_vue = new Vue({

			el: '#impact-stories',

			data: {
				stories: <?php echo json_encode(get_field('add_stories')); ?>,
				filters: [],
				types: [],
				countries: []
			},
			computed: {

				getStories: function() {
					return this.stories.slice(1);
				}

			},
			watch: {
				'filters':  function () {
					this.filter();
				}
			},
			methods: {

				filter: function() {

					// console.log(item);

					// this.filters.push(item);

					// reset all resources

					// this.stories.forEach(function(story, index) {
					// 	story.display = true;
					// });

					// apply filters

					// if ( this.filters.length ) {
					//
					// 	this.stories.forEach(function(story, index) {
					//
					// 		// if ( ! intersection(Object.keys(story.taxonomies['story-type']), this.filter_story_type) ) {
					// 		// 	story.display = false;
					// 		// }
					//
					// 	}.bind(this));
					//
					// }


				},

			},

			ready: function() {

				var types = [];
				var countries = [];

				this.stories.forEach(function(event) {

					types.push({
						"name": event.story_type[0].name,
						"slug": event.story_type[0].slug
					});

					countries.push({
						"name": event.country[0].name,
						"slug": event.country[0].slug
					});

				});

				this.$data.types.push(types);
				this.$data.countries.push(countries);

			}

		});

	</script>

<?php get_footer(); ?>
