<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="page__container">

		<div class="wrapper / page__wrapper / page--padding">

			<div class="page-title">
				<h1><?php the_title(); ?></h1>
			</div>

			<aside class="page-sidebar">
				<?php get_partial('navigation', 'sections'); ?>
				<?php get_partial('sidebar', 'page-download'); ?>
			</aside>

			<article class="page-content cf">

				<section>
					<?php the_content(); ?>
				</section>

			</article>

		</div> <!-- / .wrapper -->

		<?php get_partial('page', 'strips'); ?>

	</div> <!-- / .page__container -->

<?php get_footer(); ?>
