<?php

	global $post;

	$primary_title = get_field('primary_title') ?: 'Add primary title here&hellip;';
	$primary_posts = get_field('primary_stories');

	$secondary_title = get_field('secondary_title') ?: 'Add secondary title here&hellip;';
	$secondary_posts = get_field('secondary_stories');

	$background_colour = get_field('background_colour') ?: '#6C75E1';
	$text_colour = isContrastingColourLight($background_colour) ? '#FFF' : '#000';
	$text_colour = get_field('text_colour') ?: $text_colour;

?>

<div class="block block--stories" style="color: <?php echo $text_colour; ?>; background-color: <?php echo $background_colour; ?>">

	<h1 class="block__heading"><?php echo $primary_title; ?></h1>

	<?php if ( $primary_posts ) : ?>

		<?php foreach ( $primary_posts as $post_id ) : ?>

			<?php setup_postdata($post = $post_id); ?>

			<?php the_partial('card', 'image'); ?>

		<?php endforeach; /* and */ wp_reset_postdata(); ?>

	<?php endif; ?>


	<h2 class="block__heading"><?php echo $secondary_title; ?></h2>

	<?php if ( $secondary_posts ) : ?>

		<?php foreach ( $secondary_posts as $post_data ) : ?>

			<?php setup_postdata($post = $post_data['post']); ?>

			<?php the_partial('card', 'primary'); ?>

		<?php endforeach; /* and */ wp_reset_postdata(); ?>

	<?php endif; ?>

</div>
