<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="page--one-column">

		<div class="page__wrapper">

			<?php get_partial('page', 'title'); ?>

			<article class="page-content cf">

				<section>
					<?php the_content(); ?>
				</section>

			</article>

		</div> <!-- / .page__wrapper -->

		<?php get_partial('page', 'strips'); ?>

	</div> <!-- / .page--one-column -->

<?php get_footer(); ?>
