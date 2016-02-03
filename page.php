<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<?php $sections = get_sections(); ?>

	<div class="wrapper">

		<?php get_partial('breadcrumbs'); ?>

		<nav>

			<h3 class="border-top border-top--clean">Further Information</h3>

			<ul class="nav nav--vertical nav--sub-page">
				<li><a href="#">Team</a></li>
				<li><a href="#">Financing</a></li>
				<li><a href="#">Contracts</a></li>
				<li><a href="#">Advisory Board</a></li>
				<li><a href="#">Partners</a></li>
			</ul>

		</nav>

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

		<a href="#" class="download-cta">

			<img src="http://placehold.it/464x230" alt="" />

			<div class="download-cta__content">

				<span>Download</span>

				<div class="heading-highlight">
					<h4>2015 - 2018 Strategy document</h4>
				</div>

			</div>

		</a>

		<article class="cf">

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
