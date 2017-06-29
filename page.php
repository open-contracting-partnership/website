<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="page__container page--one-column">

		<div class="wrapper / page__wrapper / page--padding">

			<?php get_partial('page', 'title'); ?>

			<article class="page-content cf">

				<section>
					<?php the_content(); ?>
				</section>

			</article>

		</div> <!-- / .wrapper -->

		<?php get_partial('page', 'strips'); ?>

	</div> <!-- / .page__container -->

<?php get_footer(); ?>
