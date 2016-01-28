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

			<?php get_partial('post-object', 'featured'); ?>

		<?php endforeach; ?>

		<?php

			$popular_tags = get_terms('post_tag', [
				'orderby' => 'count',
				'number' => 15
			]);

		?>

		<?php if ( $popular_tags ) : ?>

			<section>

				<h2>Popular Tags</h2>

				<ul class="button__list">

					<?php foreach ( $popular_tags as $popular_tag ) : ?>
						<li><a href="<?php echo get_term_link($popular_tag); ?>" class="button button--uppercase button--thick"><?php echo $popular_tag->name; ?></a></li>
					<?php endforeach; ?>

				</ul>

			</section>

		<?php endif; ?>

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

			<?php get_partial('post-object', 'vertical'); ?>

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

	</div>

	<div class="blog__newsletter-signup">

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
			<?php get_partial('post-object', 'vertical'); ?>
		<?php endforeach; ?>

	</div>

	<?php if ( $authors = get_authors_by_count(6) ) : ?>

		<section class="blog__authors">

			<h3 class="border-top">Posts by Author</h3>

			<ul>

				<?php foreach ( $authors as $author ) : ?>
					<li><a href="<?php echo $author->url; ?>"><?php echo $author->display_name; ?> (<?php echo $author->post_count; ?>)</a></li>
				<?php endforeach; ?>

			</ul>

		</section>

	<?php endif; ?>

<?php get_footer(); ?>
