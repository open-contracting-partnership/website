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

			<article>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</article>

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

			<article>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</article>

		<?php endforeach; ?>

	</section>

	<div class="blog__event-tablet">
		#4 (tablet only)
	</div>

	<section class="blog__topics">
		#5
	</section>

	<section class="blog__news">

		<?php

			$recent_posts = new query_loop([
				'post_type' => 'post',
				'posts_per_page' => 4,
				'post__not_in' => $exclude_ids
			]);

		?>

		<?php foreach ( $recent_posts as $recent_post ) : ?>

			<article>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</article>

		<?php endforeach; ?>

	</section>

	<div class="blog__event-desktop">
		#7 (desktop only)
	</div>

	<div class="blog__newsletter-signup">
		#8
	</div>

	<div class="blog__posts">
		#9
	</div>

	<section class="blog__authors">
		#10 (desktop / tablet only)
	</section>

<?php get_footer(); ?>
