<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="page--one-column">

		<div class="page__wrapper / worldmap-header">
			<?php get_partial('page', 'title'); ?>
		</div>

		<iframe id="worldmap" src="<?php bloginfo('template_directory'); ?>/endpoints/map.php" width="300" height="540" style="display: block; max-width: 1600px; margin: 0 auto;"></iframe>

		<div class="page__wrapper">

			<article class="page-content cf">

				<section>
					<?php the_content(); ?>
				</section>

			</article>

		</div> <!-- / .page__wrapper -->

		<?php get_partial('page', 'strips'); ?>

	</div> <!-- / .page--one-column -->

<?php get_footer(); ?>
