<?php // single.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="wrapper">

		<article class="<?php if ( has_post_thumbnail() ) : ?>post--has-thumbnail<?php endif; ?> cf">

			<div class="blog__title">
				<span class="post-type"><?php the_post_type_label(); ?></span>
				<h1><?php the_title(); ?></h1>
			</div>

			<section class="post-content">

				<div class="blog__author-meta">

					<p class="blog__mobile-date"><?php pll_e('Written By'); ?> <?php the_authors(TRUE); ?>, <datetime><?php the_date(); ?></datetime></p>

				</div>


				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail(); ?>
				<?php endif; ?>

				<?php the_content(); ?>

				<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
					<?php comments_template(); ?>
				<?php endif; ?>

			</section>

			<aside class="sidebar">

				<section>
					<h3 class="border-top"><?php pll_e('Written By'); ?></h3>
					<div class="blog__author-meta">
						<p><?php the_authors(TRUE); ?> <time datetime="<?php the_time(DATE_W3C); ?>"><br /><?php OCP::the_date(); ?></time></p>
					</div>

				</section>

				<section>

					<h3 class="border-top"><?php pll_e('Share'); ?></h3>

					<ul class="button__list button__social">
						<li><a href="<?php echo share_links()->facebook; ?>" target="_blank" class="button"><svg><use xlink:href="#icon-facebook" /></svg></a></li>
						<li><a href="<?php echo share_links()->linkedin; ?>" target="_blank" class="button"><svg><use xlink:href="#icon-linkedin" /></svg></a></li>
						<li><a href="<?php echo share_links()->twitter; ?>" target="_blank" class="button"><svg><use xlink:href="#icon-twitter" /></svg></a></li>
					</ul>

				</section>

				<?php if ( $open_contracting = get_field('open_contracting') ) : ?>

					<?php

						$query = array(
							'post_type' => 'resource',
							'posts_per_page' => 3,
							'meta_query' => ['relation' => 'OR']
						);

						foreach ( $open_contracting as $term ) {

							$query['meta_query'][] = array(
								'key' => 'open_contracting',
								'value' => '"' . $slug->term . '"',
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
									<a href="<?php echo get_term_link($post_tag); ?>" class="button button--tag button--small"><?php echo $post_tag->name; ?></a>
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
