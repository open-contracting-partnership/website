<?php // single.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<article>

		<section>

			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

			<p class="blog__mobile-date">Written By <?php the_authors(TRUE); ?>, <datetime><?php the_date(); ?></datetime></p>

			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail(); ?>
			<?php endif; ?>

			<?php the_content(); ?>

		</section>

		<aside class="sidebar">

			<section>
				<h4>Written By</h4>
				<p><?php the_authors(TRUE); ?>, <time datetime="<?php the_time(DATE_W3C); ?>"><?php the_time(); ?></time></p>
			</section>

			<section>

				<h4>Share</h4>

				<ul>
					<li><a href="<?php echo share_links()->twitter; ?>">Twitter</a></li>
					<li><a href="<?php echo share_links()->facebook; ?>">Facebook</a></li>
					<li><a href="<?php echo share_links()->linkedin; ?>">LinkedIn</a></li>
				</ul>

			</section>

			<section>
				<h4>Relevant Resources</h4>
				<ul>
					<li>Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper.</li>
					<li>Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper.</li>
					<li>Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper.</li>
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

					<h4>Related Tags</h4>

					<ul>

						<?php foreach ( $post_tags as $post_tag ) : ?>

							<li>
								<a href="<?php echo get_term_link($post_tag); ?>"><?php echo $post_tag->name; ?></a>
							</li>

						<?php endforeach; ?>

					</ul>

				</section>

			<?php endif; ?>

		</aside>

	</article>

	<section class="related-posts">

		<h2>Related Posts</h2>

		<img src="http://placehold.it/400x300" />
		<img src="http://placehold.it/400x300" />
		<img src="http://placehold.it/400x300" />
		<img src="http://placehold.it/400x300" />
		<img src="http://placehold.it/400x300" />
		<img src="http://placehold.it/400x300" />

	</section>

<?php get_footer(); ?>
