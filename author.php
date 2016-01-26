<?php // author.php ?>

<?php get_header(); ?>

	<?php $author = get_userdata(get_query_var('author')); ?>

	<h3>Author Archive:</h3>
	<h1><?php echo $author->display_name; ?></h1>

	<?php

		$posts_per_page = 10;
		$page_number = ! isset($_GET['_page']) ? 1 : $_GET['_page'];
		$limit = $posts_per_page;
		$offset = ($page_number - 1) * $posts_per_page;

		$sql = "SELECT SQL_CALC_FOUND_ROWS  *
			FROM ocp_posts
			JOIN ocp_postmeta m1 ON ocp_posts.id = m1.post_id
			WHERE 1=1
			AND (ocp_posts.post_author = {$author->ID} OR (
				m1.meta_key LIKE 'authors_%' AND m1.meta_value = {$author->ID}
			))
			AND ocp_posts.post_type IN ('post', 'news', 'resource', 'media-clipping')
			AND (ocp_posts.post_status = 'publish')
			GROUP BY ocp_posts.id
			ORDER BY ocp_posts.post_date DESC
			LIMIT {$offset}, {$limit};";

		$results = $wpdb->get_results($sql, OBJECT);

		$records_found = $wpdb->get_var('SELECT FOUND_ROWS()');
		$has_more_records = ($page_number * $limit) < $records_found;

	?>

	<?php foreach ( $results as $post ) : ?>

		<?php setup_postdata($post); ?>

		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	<?php endforeach; ?>

	<?php if ( $has_more_records ) : ?>
		<a href="?_page=<?php echo $page_number + 1; ?>">Show more results</a>
	<?php endif; ?>

<?php get_footer(); ?>
