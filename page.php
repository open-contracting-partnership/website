<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="wrapper">

		<nav>
			<ul class="nav nav--horizontal nav--breadcrumbs">
				<li><a href="#">Home</a></li>
				<li><a href="#">About Us</a></li>
			</ul>
		</nav>

		<article class="cf">

			<div class="blog__title">
				<h1><?php the_title(); ?></h1>
			</div>

			<section>

				<p class="blog__mobile-date">Written By <?php the_authors(TRUE); ?>, <datetime><?php the_date(); ?></datetime></p>

				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail(); ?>
				<?php endif; ?>

				<?php the_content(); ?>

			</section>

			<aside class="sidebar">

				<section>
					<h3 class="border-top">Written By</h3>
					<p><?php the_authors(TRUE); ?>, <time datetime="<?php the_time(DATE_W3C); ?>"><?php the_time(get_option('date_format')); ?></time></p>
				</section>

				<section>

					<h3 class="border-top">Share</h3>

					<ul class="button__list button__social">
						<li><a href="#" class="button"><svg><use xlink:href="#icon-facebook" /></svg></a></li>
						<li><a href="#" class="button"><svg><use xlink:href="#icon-linkedin" /></svg></a></li>
						<li><a href="#" class="button"><svg><use xlink:href="#icon-twitter" /></svg></a></li>
					</ul>

				</section>

				<?php if ( $open_contracting = get_field('open_contracting') ) : ?>

					<?php

						$query = array(
							'post_type' => 'resource',
							'posts_per_page' => 3,
							'meta_query' => ['relation' => 'OR']
						);

						foreach ( $open_contracting as $value ) {

							$query['meta_query'][] = array(
								'key' => 'open_contracting',
								'value' => '"' . $value . '"',
								'compare' => "LIKE"
							);

						}

						$relevant_resources = new query_loop($query);

					?>

					<?php if ( $relevant_resources->have_posts() ) : ?>

						<section>

							<h3 class="border-top">Relevant Resources</h3>

							<ul class="relevant-resources">

								<?php foreach ( $relevant_resources as $relevant_resource ) : ?>
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php endforeach; ?>

							</ul>

						</section>

					<?php endif; ?>

				<?php endif; ?>

				<?php
					$post_tags = wp_get_post_terms(get_the_ID(), 'post_tag', array(
						'orderby' => 'count',
						'order' => 'DESC'
					));

				?>

				<?php if ( $post_tags ) : ?>

					<section>

						<h3 class="border-top">Related Tags</h3>

						<ul class="button__list">

							<?php foreach ( $post_tags as $post_tag ) : ?>

								<li>
									<a href="<?php echo get_term_link($post_tag); ?>" class="button button--uppercase button--thick"><?php echo $post_tag->name; ?></a>
								</li>

							<?php endforeach; ?>

						</ul>

					</section>

				<?php endif; ?>

			</aside>

		</article>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
