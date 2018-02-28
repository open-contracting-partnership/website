<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="page--one-column">

		<div class="page__wrapper / worldmap-header">
			<?php get_partial('page', 'title'); ?>
		</div>

		<div id="worldwide">
			<router-view></router-view>
		</div>

		<div class="page__wrapper">

			<article class="page-content cf">

				<section>
					<?php the_content(); ?>
				</section>

			</article>

		</div> <!-- / .page__wrapper -->

		<?php get_partial('page', 'strips'); ?>

	</div> <!-- / .page--one-column -->

	<script src="<?php bloginfo('template_directory'); ?>/dist/js/worldwide.min.js"></script>

<?php get_footer(); ?>
