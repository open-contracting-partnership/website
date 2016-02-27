<?php // partials/page/strips.php ?>

<?php if ( have_rows('page_strips') ) : ?>

	<?php while ( have_rows('page_strips') ) : the_row(); ?>
		<?php get_partial('page', 'strip'); ?>
	<?php endwhile; ?>

<?php endif; ?>
