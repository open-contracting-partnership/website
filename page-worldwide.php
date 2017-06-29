<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="page__container">

		<div class="wrapper / page__wrapper / page--padding">

			<?php get_partial('page', 'title'); ?>

			<?php if ( get_field('introduction') ) : ?>

				<blockquote class="worldwide-intro">
					<?php the_field('introduction'); ?>
				</blockquote>

			<?php endif; ?>

		</div>

		<iframe id="worldmap" src="<?php bloginfo('template_directory'); ?>/endpoints/map.php" width="300" height="540" style="display: block; max-width: 1600px; margin: 0 auto;"></iframe>

		<div class="wrapper">

			<article class="page-content cf">

				<section>

					<?php the_content(); ?>

				</section>

			</article>

		</div> <!-- / .wrapper -->

		<?php get_partial('page', 'strips'); ?>

	</div> <!-- / .page__container -->

<?php get_footer(); ?>