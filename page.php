<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="wrapper / page--padding">

		<aside class="page-sidebar">

			<?php get_partial('navigation', 'sections'); ?>

			<a href="#" class="download-cta">

				<img src="http://placehold.it/464x230" alt="" />

				<div class="download-cta__content">

					<span><?php pll_e('Download'); ?></span>

					<div class="heading-highlight">
						<h4>2015 - 2018 Strategy document</h4>
					</div>

				</div>

			</a>

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

<?php get_footer(); ?>
