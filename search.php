<?php // search.php ?>

<?php get_header(); ?>

	<?php

		$search_query = get_search_query();

		global $wp_query;

		// fetch original ids
		$original_post_ids = array_map(function($post) {
			return $post->ID;
		}, $wp_query->posts);

		// fetch the author post ids
		$author_post_ids = get_search_author_post_ids();

		// build a new, unique post ids array
		$search_post_ids = array_unique(array_merge($original_post_ids, $author_post_ids));

		// finally re-run the query
		query_posts([
			'post_type' => ['post', 'page', 'news', 'event', 'resource'],
			'post__in' => $search_post_ids,
			'orderby' => 'post__in'
		]);

	?>

	<div class="wrapper / page__wrapper">

		<main class="search-main">

			<span class="archive-content__sub-title"><?php _e("Search Results /", 'ocp'); ?></span>

			<h1><?php echo $search_query; ?></h1>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_partial('post-object', 'horizontal-search'); ?>
				<?php endwhile; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<a href="<?php echo get_previous_posts_page_link(); ?>" class="button"><?php _e('Previous Page', 'ocp'); ?></a>
				<?php endif; ?>

				<?php if ( get_next_posts_link() ) : ?>
					<a href="<?php echo get_next_posts_page_link(); ?>" class="button"><?php _e('Next Page', 'ocp'); ?></a>
				<?php endif; ?>

			<?php else : ?>
				<p><?php _e('There are no search results', 'ocp'); ?></p>
			<?php endif; ?>

		</main>

	</div>

<?php get_footer(); ?>
