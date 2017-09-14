<?php get_header(); ?>

	<?php the_post(); ?>

	<div id="impact-stories">

		<div class="wrapper">
			<?php get_partial('page', 'title'); ?>
		</div>

		<story-featured :story="stories[0]"></story-featured>

		<div class="wrapper">

			<div class="cf">

				<aside class="impact-stores__sidebar">

					<h3>Filter Search</h3>

					<div>

						<h2>Story Type</h2>

						<label v-for="type in types[0]">
							<input type="checkbox" :value="type.slug" v-model="filters">
							{{ type.name }}
						</label>

					</div>

					<div>

						<h2>Country</h2>

						<label v-for="country in countries[0]">
							<input type="checkbox" :value="country.slug" v-model="filters">
							{{ country.name }}
						</label>

					</div>

				</aside>

				<section class="impact-stories__main">

					<div v-for="story in getStories">
						<story-card :story="story"></story-card>
					</div>

				</section>

			</div>

		</div> <!-- / .page__wrapper -->

	</div>

	<script src="<?php bloginfo('template_directory'); ?>/dist/js/impact-stories.min.js"></script>

<?php get_footer(); ?>
