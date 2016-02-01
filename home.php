<?php // home.php ?>

<?php get_header(); ?>

	<div class="wrapper / blog__container">

		<?php $exclude_ids = []; ?>

		<div class="coloured">
			<h3>Recent Posts</h3>
		</div>

		<div class="blog__featured / band band--thick">

			<?php

				$featured_blog = new query_loop([
					'post_type' => 'post',
					'posts_per_page' => 1,
					'meta_query' => array(
						array(
							'key' => 'featured',
							'value' => TRUE
						)
					)
				]);

			?>

			<?php foreach ( $featured_blog as $featured_blog ) : ?>

				<?php $exclude_ids[] = get_the_ID(); ?>

				<article class="band band--thick">
					<?php get_partial('post-object', 'vertical--featured'); ?>
				</article>

			<?php endforeach; ?>

			<?php

				$popular_tags = get_terms('post_tag', [
					'orderby' => 'count',
					'number' => 15
				]);

			?>

			<?php if ( $popular_tags ) : ?>

				<section>

					<div class="coloured">
						<h3>Popular Tags</h3>
					</div>

					<ul class="button__list">

						<?php foreach ( $popular_tags as $popular_tag ) : ?>
							<li><a href="<?php echo get_term_link($popular_tag); ?>" class="button button--uppercase button--tag"><?php echo $popular_tag->name; ?></a></li>
						<?php endforeach; ?>

					</ul>

				</section>

			<?php endif; ?>

		</div>

		<div class="blog__event-mobile">
			#2 (mobile only)
		</div>

		<section class="blog__recent / band band--thick">

			<?php

				$recent_posts = new query_loop([
					'post_type' => 'post',
					'posts_per_page' => 4,
					'post__not_in' => $exclude_ids
				]);

			?>

			<?php foreach ( $recent_posts as $recent_post ) : ?>

				<?php $exclude_ids[] = get_the_ID(); ?>

				<?php get_partial('post-object', 'vertical--light'); ?>

			<?php endforeach; ?>

		</section>

		<section class="blog__filter / band band--thick">

			<div class="island island--light">

				<div class="blog__filter__selector">

					<h3 class="border-top border-top--dark">Filter posts by issue</h3>

					<form class="custom-radio" action="#" method="post">
						<label><input type="radio" name="blog-filter"><span></span>Construction</label>
						<label><input type="radio" name="blog-filter"><span></span>Land</label>
						<label><input type="radio" name="blog-filter"><span></span>Health</label>
						<label><input type="radio" name="blog-filter"><span></span>Water</label>
						<label><input type="radio" name="blog-filter"><span></span>Natural Resources</label>
						<label><input type="radio" name="blog-filter"><span></span>Education</label>
						<label><input type="radio" name="blog-filter"><span></span>Procurement Law</label>
					</form>

				</div>

				<div class="blog__filter__posts">

					<a class="post-object post-object--vertical post-object--light" href="<?php the_permalink(); ?>">

						<div class="post-object__media">

							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail('2x1_460'); ?>
							<?php else : ?>
								<img src="http://placehold.it/460x230" alt="">
							<?php endif; ?>

							<span class="post-object__tag"><?php the_post_type_label(); ?></span>

						</div>

						<div class="post-object__content">

							<div class="post-object__content-meta">
								<span class="post-object__author">By Theresa Stevens</span>
								<span class="post-object__age">1H ago</span>
								<span class="post-object__comment-count">21</span>
							</div>

							<h4><?php the_title(); ?></h4>

						</div>

					</a>

					<a class="post-object post-object--vertical post-object--light" href="<?php the_permalink(); ?>">

						<div class="post-object__media">

							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail('2x1_460'); ?>
							<?php else : ?>
								<img src="http://placehold.it/460x230" alt="">
							<?php endif; ?>

							<span class="post-object__tag"><?php the_post_type_label(); ?></span>

						</div>

						<div class="post-object__content">

							<div class="post-object__content-meta">
								<span class="post-object__author">By Theresa Stevens</span>
								<span class="post-object__age">1H ago</span>
								<span class="post-object__comment-count">21</span>
							</div>

							<h4><?php the_title(); ?></h4>

						</div>

					</a>

					<a class="post-object post-object--vertical post-object--light" href="<?php the_permalink(); ?>">

						<div class="post-object__media">

							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail('2x1_460'); ?>
							<?php else : ?>
								<img src="http://placehold.it/460x230" alt="">
							<?php endif; ?>

							<span class="post-object__tag"><?php the_post_type_label(); ?></span>

						</div>

						<div class="post-object__content">

							<div class="post-object__content-meta">
								<span class="post-object__author">By Theresa Stevens</span>
								<span class="post-object__age">1H ago</span>
								<span class="post-object__comment-count">21</span>
							</div>

							<h4><?php the_title(); ?></h4>

						</div>

					</a>

				</div>

				<div class="blog__filter__view-all">
					<a href="#" class="button button--white button--open button--bg-dark">View more by this issue</a>
				</div>

			</div>

		</section> <!-- blog__filter -->

		<div class="blog__event-tablet">
			#4 (tablet only)
		</div>

		<?php if ( $topics = get_field('featured_topics', 'options') ) : ?>

			<section class="blog__topics">

				<?php foreach ( $topics as $topic ) : ?>
					<p><?php echo $topic->name; ?></p>
				<?php endforeach; ?>

				<h3 class="coloured">Topic Highlights</h3>

			</section>

		<?php endif; ?>

		<section class="blog__news / band band--thick">

			<div class="coloured">
				<h3>Recent News</h3>
			</div>

			<div>

				<?php

					$news_posts = new query_loop([
						'post_type' => 'news',
						'posts_per_page' => 4,
					]);

				?>

				<?php foreach ( $news_posts as $news_post ) : ?>
					<?php get_partial('post-object', 'horizontal--small'); ?>
				<?php endforeach; ?>

			</div>

		</section>

		<div class="blog__event-desktop">

		</div>

		<div class="blog__newsletter-signup">

		</div>

		<div class="blog__posts">

			<div class="coloured">
				<h3>More Blogs</h3>
			</div>

			<?php

				$recent_posts = new query_loop([
					'post_type' => 'post',
					'posts_per_page' => 9,
					'post__not_in' => $exclude_ids
				]);

			?>

			<div>

				<?php foreach ( $recent_posts as $recent_post ) : ?>
					<?php get_partial('post-object', 'vertical--light'); ?>
				<?php endforeach; ?>

			</div>

		</div>

		<?php if ( $authors = get_authors_by_count(6) ) : ?>

			<section class="blog__authors">

				<h3 class="border-top">Posts by Author</h3>

				<ul class="nav nav--vertical nav--thick">

					<?php foreach ( $authors as $author ) : ?>
						<li><a href="<?php echo $author->url; ?>"><?php echo $author->display_name; ?> (<?php echo $author->post_count; ?>)</a></li>
					<?php endforeach; ?>

				</ul>

			</section>

		<?php endif; ?>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
