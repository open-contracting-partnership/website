<?php // page-global-principles.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="accent--orange">

		<section class="page-hero">

			<div class="wrapper">

				<div class="page-hero__content">

					<h1><span>Why Open Contracting</span></h1>

				</div>

			</div>

		</section>

		<div class="wrapper">

			<?php // get_partial('navigation', 'breadcrumbs'); ?>

			<aside class="page-sidebar page-sidebar--wide">

				<div class="page-navigation cf">

					<?php get_partial('navigation', 'sub-pages'); ?>

					<?php get_partial('navigation', 'sections'); ?>

				</div>

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
