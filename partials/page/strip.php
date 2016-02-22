<?php

	$options = get_partial_options($options, array(
		'reverse' => FALSE,
		'colour' => NULL
	));

	$classes = ['page-strip'];

	if ( get_sub_field('float') === 'left' ) {
		$classes[] = 'page-strip--reverse';
	}

	if ( $colour = get_sub_field('colour') ) {
		$classes[] = 'page-strip--' . $colour;
	}

?>


<section class="<?php echo implode(' ', $classes); ?>">

	<div class="wrapper">

		<?php if ( $image = get_sub_field('image') ) : ?>

			<div class="page-strip__media">
				<img src="<?php echo $image['sizes']['large']; ?>" alt="" />
			</div>

		<?php endif; ?>

		<div class="page-strip__content">
			<h3><?php the_sub_field('title'); ?></h3>
			<?php the_sub_field('content'); ?>
		</div>

	</div>

</section>
