<?php // front-page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="homepage-hero">

		<div class="wrapper">

			<div class="homepage-cta">

				<p><?php the_field('strapline'); ?></p>

				<!-- <a href="/about" class="button button--padded button--white"><?php pll_e('About Our Work'); ?></a>
				<a href="/data-standard" class="button button--padded button--white"><?php pll_e('Visit the Data Standard'); ?></a> -->

			</div> <!-- homepage-cta -->

		</div>

	</div>

	<section class="homepage-contracting / band band--thick / island island--thick island--dark">

		<div class="wrapper">

			<div class="homepage-title">
				<h1><?php pll_e('A Revolutionary Approach'); ?></h1>
			</div>

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

	<section class="band band--thick">

		<div class="wrapper--inner">

			<div class="cta-block__container">

				<div class="cta-block cta-block--report cta-block--brand">

					<?php

						$temp_post = new query_loop([
							'post_type' => 'post',
							'posts_per_page' => 1
						]);

						$temp_post = $temp_post->query->posts;

					?>

					<?php if ( load_post($temp_post, 0) ) : ?>

					<img src="<?php bloginfo('template_directory'); ?>/assets/img/rocket-2.jpg" alt="" />

						<time><?php the_time(get_option('date_format')); ?></time>

						<h2><?php the_title(); ?></h2>

						<?php the_excerpt(); ?>

						<a href="<?php the_permalink(); ?>" class="button button--padded">View Blog</a>

					<?php endif; /* AND */ wp_reset_postdata(); ?>

				</div>

				<div class="cta-block cta-block--background">

					<img src="<?php bloginfo('template_directory'); ?>/assets/img/street.jpg" alt="" />

					<h2>Implement Open Contracting</h2>

					<p>Learn how to implement open contracting or use contracting data.</p>

					<div><a href="#" class="button">Showcases and evidence</a></div>
					<div><a href="#" class="button">How to get started</a></div>
					<div><a href="#" class="button">Data standard</a></div>

				</div>

			</div>

		</div>

	</section>

	<div class="wrapper">

		<section class="homepage-filter / band band--extra-thick">

			<div class="posts-filter / band">

				<div class="posts-filter__inner">

					<a href="#" class="posts-filter__button"><svg><use xlink:href="#icon-filter" /></svg><?php pll_e('Filter Blogs & Updates'); ?></a>

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
					<p><svg><use xlink:href="#icon-twitter" /></svg><?php echo $tweets['tweets'][0]['content']; ?></p>
				</div>

				<?php if ( load_post($latest_posts, 0) ) : ?>
					<?php get_partial('post-object', 'homepage-filter'); ?>
				<?php endif; ?>

				<?php if ( load_post($latest_news, 1) ) : ?>
					<?php get_partial('post-object', 'homepage-filter'); ?>
				<?php endif; ?>

				<?php if ( load_post($latest_posts, 2) ) : ?>
					<?php get_partial('post-object', 'homepage-filter'); ?>
				<?php endif; ?>

				<div class="homepage-filter__item / homepage-filter__twitter">
					<p><svg><use xlink:href="#icon-twitter" /></svg><?php echo $tweets['tweets'][1]['content']; ?></p>
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
						<p><svg><use xlink:href="#icon-twitter" /></svg><?php echo $tweets['tweets'][$i]['content']; ?></p>
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

			<div class="homepage-map__image">

				<div class="homepage-map__image-item">
					<a href="/why-open-contracting/showcase-projects/mexico-city/" class="button button--white">Mexico&nbsp;City</a>
				</div>

				<div class="homepage-map__image-item">
					<a href="/why-open-contracting/showcase-projects/ukraine/" class="button button--white">Ukraine</a>
				</div>

			</div>

			<?php if ( have_rows('worldwide_links') ) : ?>

				<div class="homepage-map__content">

					<h3><?php pll_e('Open Contracting Worldwide'); ?></h3>

					<?php while ( have_rows('worldwide_links') ) : the_row(); ?>
						<div><a class="button button--white" href="<?php the_sub_field('link_address'); ?>"><?php the_sub_field('link_title'); ?></a></div>
					<?php endwhile; ?>

				</div>

			<?php endif; ?>

		</section>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
