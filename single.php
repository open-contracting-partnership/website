<?php // single.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="wrapper">

		<article class="cf">

			<div class="blog__title">
				<span class="post-type">Blog</span>
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

				<section>

					<h3 class="border-top">Relevant Resources</h3>

					<ul class="relevant-resources">
						<li><a href="#">Ending child marriage in Africa: Opening the door for girls’ education, health, and freedom from violence</a></li>
						<li><a href="#">Vows of poverty. 26 countries where child marriage eclipses girls’ education</a></li>
					</ul>

				</section>

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

		<!-- yarpp posts -->
		<?php if ( function_exists('related_posts') ) : ?>

			<section class="related-posts">

				<h2 class="epsilon">Related Posts</h2>

				<?php

					related_posts([
						'template' =>'yarpp-template-posts.php',
						'limit' => 6
					]);

				?>

			</section>

		<?php endif; ?>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
