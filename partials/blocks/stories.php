<?php

	global $post;

	$title = get_field('title') ?: 'Add your title here&hellip;';
	$primary_posts = get_field('primary_stories');

?>

<h1><?php echo $title; ?></h1>

<?php if ( $primary_posts ) : ?>

	<?php foreach ( $primary_posts as $post_id ) : ?>

		<?php setup_postdata($post = $post_id); ?>

		<?php the_partial('card', 'image'); ?>

	<?php endforeach; /* and */ wp_reset_postdata(); ?>

<?php endif; ?>
