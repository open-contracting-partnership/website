<?php // front-page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="homepage-hero">

		<div class="wrapper">

			<div class="homepage-cta">

				<p><?php the_field('strapline'); ?></p>

				<a href="/about" class="button button--white"><?php pll_e('About Our Work'); ?></a>
				<a href="/data-standard" class="button button--white"><?php pll_e('Visit the Data Standard'); ?></a>

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
							<p><?php the_sub_field('copy'); ?></p>
						</div>

					<?php endwhile; ?>

				</div> <!-- / .stat-container -->

			<?php endif; ?>

		</div>

	</section> <!-- stat-modules -->

	<div class="wrapper">

		<div class="band band--thicker">

			<div class="homepage-blogs">

				<section>

					<h3 class="border-top"><?php pll_e('Recent Blogs'); ?></h3>

					<?php

						$recent_posts = new query_loop([
							'post_type' => 'post',
							'posts_per_page' => 3
						]);

					?>

					<?php foreach ( $recent_posts as $recent_post ) : ?>

						<a href="<?php the_permalink(); ?>" class="post-object post-object--horizontal / media">

							<div href="#" class="post-object__media / media__object">
								<?php the_post_thumbnail('hemo_horizontal'); ?>
							</div>

							<div class="post-object__content / media__body">
								<div>
									<h4><?php the_title(); ?></h4>
								</div>
								<p>By <?php the_authors(); ?></p>
							</div>

						</a>

					<?php endforeach; ?>

				</section>

			</div> <!-- homepage-blogs -->

			<div class="homepage-spotlight">

				<section>

					<h3 class="border-top"><?php pll_e('Spotlight'); ?></h3>

					<a href="#" class="post-object post-object--vertical post-object--spotlight">

						<?php if ( have_rows('spotlight') ) : while( have_rows('spotlight') ) : the_row(); ?>

							<div class="post-object__media">

								<img src="http://unsplash.it/459/235" alt="">

								<div class="post-object--spotlight__title">
									<span class="post-object__tag">Projects</span>

									<?php if ( get_sub_field('title') ) : ?>
										<h4><?php the_sub_field('title') ?></h4>
									<?php else : ?>
										<h4><?php pll_e('Help us define our openness'); ?></h4>
									<?php endif; ?>

								</div>

							</div>

							<div class="post-object__content">

								<?php if ( get_sub_field('description') ) : ?>
									<p><?php the_sub_field('description') ?></p>
								<?php else : ?>
									<p>Open is part of our name and game at the Open Contracting Partnership. This means, open is at the core of our institution. It is our mission. It is one of our core values. If we want public procurement to be open, we have to be open ourselves.</p>
								<?php endif; ?>

							</div>

						<?php endwhile; endif; ?>

					</a>

				</section>

			</div> <!-- homepage-spotlight -->

			<?php if ( have_rows('implement_links') ) : ?>

				<div class="homepage-implement">

					<section>

						<div class="heading-highlight">
							<h3><?php pll_e('Implement Open Contracting'); ?></h3>
						</div>

						<span><?php pll_e('Learn how to implement open contracting or use contracting data.'); ?></span>

						<ul class="cta-list">
							<?php while ( have_rows('implement_links') ) : the_row(); ?>
								<li><a href="<?php the_sub_field('link_address'); ?>"><?php the_sub_field('link_title'); ?></a></li>
							<?php endwhile; ?>
						</ul>

					</section>

				</div> <!-- homepage-implement -->

			<?php endif; ?>

		</div>

		<section class="homepage-filter / band band--extra-thick">

			<div class="posts-filter / band">

				<div class="posts-filter__inner">

					<a href="#" class="posts-filter__button"><svg><use xlink:href="#icon-menu" /></svg><?php pll_e('Filter Blogs & Updates'); ?></a>

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
					<p><?php echo $tweets['tweets'][0]['content']; ?></p>
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
					<p><?php echo $tweets['tweets'][1]['content']; ?></p>
				</div>

				<?php if ( load_post($latest_posts, 3) ) : ?>
					<?php get_partial('post-object', 'homepage-filter--post'); ?>
				<?php endif; ?>

				<?php for ( $i = 2; $i < 6; $i++ ) : ?>

					<div class="homepage-filter__item / homepage-filter__twitter">
						<p><?php echo $tweets['tweets'][$i]['content']; ?></p>
					</div>

				<?php endfor; ?>

				<?php for ( $i = 4; $i < 6; $i++ ) : ?>

					<?php if ( load_post($latest_posts, $i) ) : ?>
						<?php get_partial('post-object', 'homepage-filter--post'); ?>
					<?php endif; ?>

				<?php endfor; ?>

			</div>

		</section>

	</div> <!-- / .wrapper -->

	<section class="homepage-map / band">

		<div class="wrapper">

			<div class="homepage-map__image">
				<img src="<?php echo bloginfo('template_directory'); ?>/assets/img/map.svg" alt="Map highlighting Ukraine and Mexico" />
			</div>

			<?php if ( have_rows('worldwide_links') ) : ?>

				<div class="homepage-map__content">

					<h3 class="border-top border-top--clean"><?php pll_e('Worldwide'); ?></h3>

					<span><?php pll_e('Learn how to implement open contracting or use contracting data.'); ?></span>

					<ul class="cta-list">
						<?php while ( have_rows('worldwide_links') ) : the_row(); ?>
							<li><a href="<?php the_sub_field('link_address'); ?>"><?php the_sub_field('link_title'); ?></a></li>
						<?php endwhile; ?>
					</ul>

				</div>

			<?php endif; ?>

		</div> <!-- / .wrapper -->

	</section>

<?php get_footer(); ?>
