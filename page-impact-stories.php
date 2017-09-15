<?php get_header(); ?>

	<?php the_post(); ?>

	<div id="impact-stories">

		<div class="wrapper">
			<?php get_partial('page', 'title'); ?>
		</div>

		<story-featured :story="stories[0]"></story-featured>

		<div class="wrapper">

			<div class="cf">

				<div class="impact-stories__sidebar / cf">

					<div class="impact-stories__filter / cf">
						<h2>Story Type</h2>
						<button v-for="type in types" @click.prevent="toggleFilter('type', type.slug)" class="button button--tag" v-bind:class="{'active': filters.type == type.slug}">{{ type.name }}</button>
					</div>

					<div class="impact-stories__filter / cf">
						<h2>Country</h2>
						<button v-for="country in countries" @click.prevent="toggleFilter('country', country.slug)" class="button button--tag" v-bind:class="{'active': filters.country == country.slug}">{{ country.name }}</button>
					</div>

				</div>

				<section class="impact-stories__main / cf">

					<div v-if="hasVisibleStories">
						<story-card v-for="story in visibleStories" :story="story"></story-card>
					</div>

					<p v-else>No stories match your filter, <a href="#" @click.prevent="resetFilter()">reset filter?</a></p>

				</section>

			</div>

		</div> <!-- / .page__wrapper -->

	</div>

	<script src="<?php bloginfo('template_directory'); ?>/dist/js/impact-stories.min.js"></script>

<?php get_footer(); ?>
