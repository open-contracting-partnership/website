<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<?php $sections = get_sections(); ?>

	<div class="wrapper">

		<?php get_partial('navigation', 'breadcrumbs'); ?>

		<aside class="page-sidebar">

			<div class="page-navigation cf">

				<?php get_partial('navigation', 'sub-pages'); ?>

				<?php if ( $sections ) : ?>

					<nav>

						<h3 class="border-top border-top--clean">Jump to section</h3>

						<ul class="nav nav--vertical nav--in-page">

							<?php foreach ( $sections as $id => $label ) : ?>
								<li><a href="#<?php echo $id; ?>"><?php echo $label; ?></a></li>
							<?php endforeach; ?>

						</ul>

					</nav>

				<?php endif; ?>

			</div>

			<a href="#" class="download-cta">

				<img src="http://placehold.it/464x230" alt="" />

				<div class="download-cta__content">

					<span>Download</span>

					<div class="heading-highlight">
						<h4>2015 - 2018 Strategy document</h4>
					</div>

				</div>

			</a>

		</aside>

		<article class="page-content cf">

			<?php

				$title = get_the_title();

				if ( $sections = get_sections() ) {
					$title = current($sections);
				}

			?>

			<div class="blog__title">

				<?php if ( $sections ) : ?>
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
