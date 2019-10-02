<?php

	global $post;

	$title = get_field('title') ?: 'Add your title here&hellip;';
	$primary_posts = get_field('primary_stories');
	$background_colour = get_field('background_colour') ?: '#6C75E1';
	$text_colour = get_field('text_colour') ?: getContrastColor($background_colour);

?>

<div class="block block--stories" style="color: <?php echo $text_colour; ?>; background-color: <?php echo $background_colour; ?>">

	<h1 class="block__heading"><?php echo $title; ?></h1>

	<?php if ( $primary_posts ) : ?>

		<?php foreach ( $primary_posts as $post_id ) : ?>

			<?php setup_postdata($post = $post_id); ?>

			<?php the_partial('card', 'image'); ?>

		<?php endforeach; /* and */ wp_reset_postdata(); ?>

	<?php endif; ?>

</div>
