<?php // front-page.php ?>

<?php get_header(); ?>

	<?php if ( have_posts() ) : the_post(); ?>

		<h1><?php the_title(); ?></h1>

		<?php the_content(); ?>

	<?php endif; ?>

<?php get_footer(); ?>