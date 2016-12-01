<?php // front-page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<?php

		function article_image($field) {
			echo 'http://ocp.imgix.net' . parse_url(get_field($field))['path'];
		}

	?>

	<div class="homepage-stories__wrapper">

		<div class="wrapper / band--thick">

			<div class="homepage-stories">

				<div class="homepage-story homepage-story--1" style="background-image: url('<?php echo article_image('first_article_article_0_image'); ?>?blend=B8C600&amp;bm=normal&amp;balph=60')">

					<a href="<?php the_field('first_article_article_0_link'); ?>">
						<h2><?php the_field('first_article_article_0_title'); ?></h2>
					</a>

					<div class="homepage-story__content">
						<?php the_field('first_article_article_0_content'); ?>
					</div>

					<p><a href="<?php the_field('first_article_article_0_link'); ?>" class="button button--padded">View Post</a></p>

				</div>

				<div class="homepage-story__right">

					<div class="homepage-story__right-top">

						<div class="homepage-story homepage-story--2" style="background-image: url('<?php echo article_image('second_article_article_0_image'); ?>?blend=00BCAD&amp;bm=normal&amp;balph=60')">

							<a href="<?php the_field('second_article_article_0_link'); ?>">
								<h3><?php the_field('second_article_article_0_title'); ?></h3>
							</a>

							<?php the_field('second_article_article_0_content'); ?>

						</div>

						<div class="homepage-story homepage-story--3" style="background-image: url('<?php echo article_image('fourth_article_article_0_image'); ?>?blend=6C75E1&amp;bm=normal&amp;balph=60')">

							<a href="<?php the_field('third_article_article_0_link'); ?>">
								<h3><?php the_field('third_article_article_0_title'); ?></h3>
							</a>

							<?php the_field('third_article_article_0_content'); ?>

						</div>

					</div>

					<div class="homepage-story homepage-story--4" style="background-image: url('<?php echo article_image('fourth_article_article_0_image'); ?>?blend=FC4E2F&amp;bm=normal&amp;balph=60')">

						<a href="<?php the_field('fourth_article_article_0_link'); ?>">
							<h2><?php the_field('fourth_article_article_0_title'); ?></h2>
						</a>

						<?php the_field('fourth_article_article_0_content'); ?>

					</div>

				</div>

			</div>

		</div> <!-- / .wrapper -->

	</div>

	<section class="homepage-contracting / band band--thick / island island--thick island--dark">

		<div class="wrapper">

			<?php if ( $stats_title = get_field('statistics_title') ) : ?>

				<div class="homepage-title">
					<h1><?php echo $stats_title; ?></h1>
				</div>

			<?php endif; ?>

			<?php if ( have_rows('statistics') ) : ?>

				<div class="stat__container">

					<?php while ( have_rows('statistics') ) : the_row(); ?>

						<div class="stat-module">
							<span><?php the_sub_field('stat'); ?></span>
							<div><p><?php the_sub_field('copy'); ?></p></div>
						</div>

					<?php endwhile; ?>

				</div> <!-- / .stat-container -->

			<?php endif; ?>

		</div>

	</section> <!-- stat-modules -->

	<div class="wrapper">

		<section class="homepage-filter / band band--extra-thick">

			<div class="posts-filter / band">

				<div class="posts-filter__inner">

					<a href="#" class="posts-filter__button"><svg><use xlink:href="#icon-filter" /></svg><?php _e('Filter Blogs & Updates', 'ocp'); ?></a>

					<form action="#" class="posts-filter__form / custom-radio / js-homepage-filter">
						<label><input type="radio" name="name" value="all" checked="checked"><span></span>All</label>
						<label><input type="radio" name="name" value="post"><span></span>Blog</label>
						<label><input type="radio" name="name" value="news"><span></span>News</label>
						<label><input type="radio" name="name" value="resource"><span></span>Resources</label>
						<label><input type="radio" name="name" value="tweet"><span></span>Tweets</label>
					</form>

				</div>

			</div>

			<?php

				// tweets
				$tweets = get_tweets();
				$tweets['tweets'] = array_values($tweets['tweets']);

				// latest posts
				$latest_posts = new query_loop([
					'post_type' => 'post',
					'posts_per_page' => 6
				]);
				$latest_posts = $latest_posts->query->posts;

				// latest news
				$latest_news = new query_loop([
					'post_type' => 'news',
					'posts_per_page' => 6
				]);
				$latest_news = $latest_news->query->posts;

				// latest resources
				$latest_resources = new query_loop([
					'post_type' => 'resource',
					'posts_per_page' => 6
				]);
				$latest_resources = $latest_resources->query->posts;

			?>

			<div class="homepage-filter__items"></div>

			<div class="homepage-filter__items-pool">

				<div class="homepage-filter__item / homepage-filter__twitter">

					<p>

						<a href="https://twitter.com/opencontracting/status/<?php echo $tweets['tweets'][0]['id']; ?>" class="tweet__status-link">
							<svg><use xlink:href="#icon-twitter" /></svg>
						</a>

						<?php echo $tweets['tweets'][0]['content']; ?>

					</p>

				</div>

				<?php if ( load_post($latest_posts, 0) ) : ?>
					<?php get_partial('post-object', 'homepage-filter'); ?>
				<?php endif; ?>

				<?php if ( load_post($latest_news, 0) ) : ?>
					<?php get_partial('post-object', 'homepage-filter'); ?>
				<?php endif; ?>

				<?php if ( load_post($latest_posts, 1) ) : ?>
					<?php get_partial('post-object', 'homepage-filter'); ?>
				<?php endif; ?>

				<div class="homepage-filter__item / homepage-filter__twitter">

					<p>

						<a href="https://twitter.com/opencontracting/status/<?php echo $tweets['tweets'][1]['id']; ?>" class="tweet__status-link">
							<svg><use xlink:href="#icon-twitter" /></svg>
						</a>

						<?php echo $tweets['tweets'][1]['content']; ?>

					</p>

				</div>

				<?php if ( load_post($latest_resources, 0) ) : ?>
					<?php get_partial('post-object', 'homepage-filter'); ?>
				<?php endif; ?>

				<?php

					//
					// SHOW EXCESS POST TYPES BELOW FOR FILTER PURPOSES
					//

				?>

				<?php for ( $i = 2; $i < 6; $i++ ) : ?>

					<div class="homepage-filter__item / homepage-filter__twitter">

						<p>

							<a href="https://twitter.com/opencontracting/status/<?php echo $tweets['tweets'][$i]['id']; ?>" class="tweet__status-link">
								<svg><use xlink:href="#icon-twitter" /></svg>
							</a>

							<?php echo $tweets['tweets'][$i]['content']; ?>

						</p>

					</div>

				<?php endfor; ?>

				<?php for ( $i = 2; $i < 6; $i++ ) : ?>

					<?php if ( load_post($latest_posts, $i) ) : ?>
						<?php get_partial('post-object', 'homepage-filter'); ?>
					<?php endif; ?>

				<?php endfor; ?>

				<?php for ( $i = 1; $i < 6; $i++ ) : ?>

					<?php if ( load_post($latest_news, $i) ) : ?>
						<?php get_partial('post-object', 'homepage-filter'); ?>
					<?php endif; ?>

				<?php endfor; ?>

				<?php for ( $i = 1; $i < 6; $i++ ) : ?>

					<?php if ( load_post($latest_resources, $i) ) : ?>
						<?php get_partial('post-object', 'homepage-filter'); ?>
					<?php endif; ?>

				<?php endfor; ?>

				<?php wp_reset_postdata(); ?>

			</div>

		</section>

		<section class="homepage-map / band">

			<?php if ( have_rows('worldwide_map_markers') ) : ?>

				<div class="homepage-map__image">

					<div class="content">

						<?php while ( have_rows('worldwide_map_markers') ) : the_row(); ?>

							<div class="homepage-map__image-item" style="left: <?php the_sub_field('left'); ?>%; top: <?php the_sub_field('top'); ?>%;">
								<a href="<?php the_sub_field('link'); ?>" class="button button--white"><?php echo str_replace(' ', '&nbsp;', get_sub_field('title')); ?></a>
							</div>

						<?php endwhile; ?>

					</div>

				</div>

			<?php endif; ?>

			<?php if ( have_rows('worldwide_links') ) : ?>

				<div class="homepage-map__content">

					<h3><?php _e('Open Contracting Worldwide', 'ocp'); ?></h3>

					<?php while ( have_rows('worldwide_links') ) : the_row(); ?>
						<div><a class="button button--white" href="<?php the_sub_field('link_address'); ?>"><?php the_sub_field('link_title'); ?></a></div>
					<?php endwhile; ?>

				</div>

			<?php endif; ?>

		</section>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
