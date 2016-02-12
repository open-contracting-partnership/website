<?php // archive.php ?>

<?php get_header(); ?>

	<div class="wrapper">

		<?php if ( is_category() ) : ?>
			<h1><?php single_cat_title(); ?></h1>
		<?php elseif( is_tag() ) : ?>
			<h1><?php single_tag_title(); ?></h1>
		<?php elseif( is_tax() ) : ?>
			<h1><?php single_cat_title(); ?></h1>
		<?php elseif (is_day()) : ?>
			<h1><?php pll_e('Archive for'); ?> <?php the_time('F jS, Y'); ?></h1>
		<?php elseif (is_month()) : ?>
			<h1><?php pll_e('Archive for'); ?> <?php the_time('F, Y'); ?></h1>
		<?php elseif (is_year()) : ?>
			<h1><?php pll_e('Archive for'); ?> <?php the_time('Y'); ?></h1>
		<?php elseif (is_author()) : ?>
			<h1><?php pll_e('Author Archive'); ?></h1>
		<?php else : ?>
			<h1><?php the_post_type_label(NULL, TRUE); ?></h1>
		<?php endif;?>

		<div class="archive-posts">

			<?php if ( have_posts() ) : while(have_posts()) : the_post(); ?>

				<?php get_partial('post-object', 'vertical--light'); ?>

			<?php endwhile; endif; ?>

		</div>

	</div>

<?php get_footer(); ?>
