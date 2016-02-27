<?php // front-page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="homepage-hero">

		<div class="wrapper">

			<div class="homepage-cta">

				<p><?php the_field('strapline'); ?></p>

				<a href="/about" class="button button--padded button--white"><?php pll_e('About Our Work'); ?></a>
				<a href="/data-standard" class="button button--padded button--white"><?php pll_e('Visit the Data Standard'); ?></a>

			</div> <!-- homepage-cta -->

		</div>

	</div>

	<section class="homepage-contracting / band band--thick / island island--thick island--dark">

		<div class="wrapper">

			<div class="homepage-title">
				<h1><?php pll_e('Public contracting'); ?></h1>
				<h2><?php pll_e('The number one corruption risk in government'); ?></h2>
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

					<img src="<?php bloginfo('template_directory'); ?>/assets/img/rocket-2.jpg" alt="" />

					<time>05-04-2016</time>

					<h2>Open Contracting in 2015: Annual Report</h2>

					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed sapien quam. Sed dapibus est id enim facilisis, at posuere turpis adipiscing. Quisque sit amet dui dui.</p>

					<a href="#" class="button button--padded">View report</a>

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

				// latest resources
				$latest_resourcs = new query_loop([
					'post_type' => 'resource',
					'posts_per_page' => 6
				]);
				$latest_resourcs = $latest_resourcs->query->posts;

			?>

			<div class="homepage-filter__items"></div>

			<div class="homepage-filter__items-pool">

				<div class="homepage-filter__item / homepage-filter__twitter">
					<p><svg><use xlink:href="#icon-twitter" /></svg><?php echo $tweets['tweets'][0]['content']; ?></p>
				</div>

				<?php if ( load_post($latest_posts, 0) ) : ?>
					<?php get_partial('post-object', 'homepage-filter--post'); ?>
				<?php endif; ?>

				<?php if ( load_post($latest_posts, 1) ) : ?>
					<?php get_partial('post-object', 'homepage-filter--post'); ?>
				<?php endif; ?>

				<?php if ( load_post($latest_posts, 2) ) : ?>
					<?php get_partial('post-object', 'homepage-filter--post'); ?>
				<?php endif; ?>

				<div class="homepage-filter__item / homepage-filter__twitter">
					<p><svg><use xlink:href="#icon-twitter" /></svg><?php echo $tweets['tweets'][1]['content']; ?></p>
				</div>

				<?php if ( load_post($latest_posts, 3) ) : ?>
					<?php get_partial('post-object', 'homepage-filter--post'); ?>
				<?php endif; ?>

				<?php for ( $i = 2; $i < 6; $i++ ) : ?>

					<div class="homepage-filter__item / homepage-filter__twitter">
						<p><svg><use xlink:href="#icon-twitter" /></svg><?php echo $tweets['tweets'][$i]['content']; ?></p>
					</div>

				<?php endfor; ?>

				<?php for ( $i = 4; $i < 6; $i++ ) : ?>

					<?php if ( load_post($latest_posts, $i) ) : ?>
						<?php get_partial('post-object', 'homepage-filter--post'); ?>
					<?php endif; ?>

				<?php endfor; ?>

				<?php wp_reset_postdata(); ?>

			</div>

		</section>

		<section class="homepage-map / band">

			<div class="homepage-map__image">

				<div class="homepage-map__image-item">
					<a href="#" class="button button--white">Mexico&nbsp;City</a>
				</div>

				<div class="homepage-map__image-item">
					<a href="#" class="button button--white">Ukraine</a>
				</div>

			</div>

			<?php if ( have_rows('worldwide_links') ) : ?>

				<div class="homepage-map__content">

					<h3><?php pll_e('Open Contracting Worldwide'); ?></h3>

					<p><?php pll_e('Learn how to implement open contracting or use contracting data.'); ?></p>

					<?php while ( have_rows('worldwide_links') ) : the_row(); ?>
						<div><a class="button button--white" href="<?php the_sub_field('link_address'); ?>"><?php the_sub_field('link_title'); ?></a></div>
					<?php endwhile; ?>

				</div>

			<?php endif; ?>

		</section>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
