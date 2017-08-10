<?php // archive-news.php ?>

<?php get_header(); ?>

	<?php

		// recent news
		$latest_news = new query_loop([
			'post_type' => 'news',
			'posts_per_page' => -1
		]);

	?>

	<div class="wrapper / news__container">

		<div class="band band--thin">

			<a href="/latest" class="text-button button--icon">
				<svg><use xlink:href="#icon-arrow-left"></svg><?php _e('Back to latest', 'ocp'); ?>
			</a>

		</div>

		<div class="page-title">
			<h1><?php the_post_type_label('news'); ?></h1>
		</div>

		<div class="news__post-items">

			<?php foreach ( $latest_news as $news ) : ?>

				<?php

					get_partial('card', 'default', [
						'display_image' => FALSE,
						'display_type' => TRUE,
						'meta_alt' => TRUE
					]);

				?>

			<?php endforeach; ?>

		</div> <!-- / .blog__post-items -->

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
