<?php // home.php ?>

<?php get_header(); ?>

	<?php $exclude_ids = []; ?>

	<div class="blog__featured">

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

			<?php get_partial('post-object', 'vertical--featured'); ?>

		<?php endforeach; ?>

		&nbsp;

	</div>

	<div class="blog__event-mobile">
		#2 (mobile only)
	</div>

	<section class="blog__recent">

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

	<div class="blog__event-tablet">
		#4 (tablet only)
	</div>

	<?php if ( $topics = get_field('featured_topics', 'options') ) : ?>

		<section class="blog__topics">

			<?php foreach ( $topics as $topic ) : ?>
				<p><?php echo $topic->name; ?></p>
			<?php endforeach; ?>

			<h2>Topic Highlights</h2>

		</section>

	<?php endif; ?>

	<section class="blog__news">

		<h2>Recent News</h2>

		<div>

			<?php

				$news_posts = new query_loop([
					'post_type' => 'news',
					'posts_per_page' => 4,
				]);

			?>

			<?php foreach ( $news_posts as $news_post ) : ?>
				<?php get_partial('post-object', 'horizontal'); ?>
			<?php endforeach; ?>

		</div>

	</section>

	<div class="blog__event-desktop">
		#7 (desktop only)
	</div>

	<div class="blog__newsletter-signup">
		#8
	</div>

	<div class="blog__posts">

		<?php

			$recent_posts = new query_loop([
				'post_type' => 'post',
				'posts_per_page' => 9,
				'post__not_in' => $exclude_ids
			]);

		?>

		<?php foreach ( $recent_posts as $recent_post ) : ?>
			<?php get_partial('post-object', 'vertical--light'); ?>
		<?php endforeach; ?>

	</div>

	<section class="blog__authors">
		#10 (desktop / tablet only)
	</section>

<?php get_footer(); ?>
