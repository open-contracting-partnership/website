<?php get_header(); ?>

	<?php the_post(); ?>

	<div id="impact-stories">

		<div class="wrapper">
			<?php get_partial('page', 'title'); ?>
		</div>

		<div class="impact-stories__featured">

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

		</div>

		<div class="wrapper">

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

	</div>

	<script src="<?php bloginfo('template_directory'); ?>/dist/js/impact-stories.min.js"></script>

<?php get_footer(); ?>
