<?php get_header(); ?>

	<?php the_post(); ?>

	<div id="impact-stories">

		<div class="wrapper">
			<?php get_partial('page', 'title'); ?>
		</div>

		<story-featured :story="stories[0]"></story-featured>

		<div class="wrapper">

			<div class="cf">

				<div class="impact-stories__sidebar	">

					<div class="impact-stories__filter">

						<h2>Story Type</h2>

						<label v-for="type in types">
							<input type="checkbox" :value="type.slug" v-model="filters.types">
							{{ type.name }}
						</label>

					</div>

					<div class="impact-stories__filter">

						<h2>Country</h2>

						<label v-for="country in countries">
							<input type="checkbox" :value="country.slug" v-model="filters.countries">
							{{ country.name }}
						</label>

					</div>

				</div>

				<section class="impact-stories__main">

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
