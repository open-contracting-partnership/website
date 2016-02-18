<?php // search.php ?>

<?php get_header(); ?>

	<div class="wrapper">

		<?php

			$search_title = sprintf(
				pll__("Search Results for '%s'"),
				get_search_query()
			);

		?>

		<h2><?php echo $search_title; ?></h2>

		<?php if ( have_posts() ) : ?>

			<article>

				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<?php the_content(); ?>

			</article>

		<?php else : ?>
			<p><?php pll_e('There are no search results'); ?></p>
		<?php endif; ?>

	</div>

<?php get_footer(); ?>
