<?php // yarpp-template-related-list ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_partial('post-object', 'vertical'); ?>
	<?php endwhile; ?>

<?php endif; ?>
