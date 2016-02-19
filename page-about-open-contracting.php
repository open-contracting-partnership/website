<?php // page-global-principles.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="accent--orange">

		<div class="wrapper / page--padding">

			<aside class="page-sidebar">
				<?php get_partial('navigation', 'sections'); ?>
			</aside>

			<article class="page-content cf">

				<div class="blog__title">

					<?php if ( $sections = get_sections() ) : ?>
						<h1 id="<?php echo key($sections); ?>"><?php echo current($sections); ?></h1>
					<?php else : ?>
						<h1><?php the_title(); ?></h1>
					<?php endif; ?>

				</div>

				<section>
					<?php the_content(); ?>
				</section>

			</article>

		</div> <!-- / .wrapper -->

	</div>

<?php get_footer(); ?>
