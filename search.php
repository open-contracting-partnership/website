<?php get_header(); ?>

<?php

	use \App\Search;

	$query = get_search_query();
	$page = get_query_var('page', 1);

	$search = new Search($query, $page);

?>

<?php if ( $search->hasResults() ) : ?>

	<?php foreach ( $search->getResults() as $result ) : ?>

		<div>
			<h4><a href="<?php echo $result->link; ?>"><?php echo $result->htmlTitle; ?></a></h4>
			<p><?php echo $result->htmlFormattedUrl; ?></p>
			<p><?php echo $result->htmlSnippet; ?></p>
		</div>

	<?php endforeach; ?>

	<?php if ( $search->hasNextPage() ) : ?>
		<p><strong><a href="/?s=<?php echo get_search_query(); ?>&page=<?php echo $page + 1; ?>">Next Page &raquo;</a></strong></p>
	<?php endif; ?>

<?php else : ?>

	<p>No results.</p>

<?php endif; ?>

<?php get_footer(); ?>
