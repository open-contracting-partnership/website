<?php // single.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<article>

		<section>

			<h1><?php the_title(); ?></h1>

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
					<li><a href="#">Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper.</a></li>
					<li><a href="#">Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper.</a></li>
					<li><a href="#">Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper.</a></li>
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

	<section class="related-posts">

		<h2 class="delta">Related Posts</h2>

		<div class="related-posts__inner">

			<a href="#" class="related-post">
				<img src="http://placehold.it/460x300" />
			</a>

			<a href="#" class="related-post">
				<img src="http://placehold.it/460x300" />
			</a>

			<a href="#" class="related-post">
				<img src="http://placehold.it/460x300" />
			</a>

			<a href="#" class="related-post">
				<img src="http://placehold.it/460x300" />
			</a>

			<a href="#" class="related-post">
				<img src="http://placehold.it/460x300" />
			</a>

			<a href="#" class="related-post">
				<img src="http://placehold.it/460x300" />
			</a>

		</div>

	</section>

<?php get_footer(); ?>
