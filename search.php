<?php // search.php ?>

<?php get_header(); ?>

	<div class="wrapper archive--padding">

		<main class="search-main">

			<span class="archive-content__sub-title"><?php _e("Search Results /", 'ocp'); ?></span>

			<h1><?php echo get_search_query(); ?></h1>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_partial('post-object', 'horizontal-search'); ?>
				<?php endwhile; ?>

			<?php else : ?>
				<p><?php _e('There are no search results', 'ocp'); ?></p>
			<?php endif; ?>

		</main>

	</div>

<?php get_footer(); ?>
