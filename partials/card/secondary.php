<?php

	$options = get_partial_options($options, array(
		'display_image' => TRUE,
		'display_strap' => FALSE,
		'image_align_right' => FALSE
	));

	$img_class = $options->image_align_right ? 'card__media--right' : '';

	$imgix_options = array(
		'crop' => 'faces',
		'fit' => 'crop',
		'w' => 152,
		'h' => 152,
		'fm' => 'pjpg'
	);

	if ( post_type_supports(get_post_type(), 'thumbnail') && has_post_thumbnail() ) {

		$image_url = imgix::source('featured')
			->options($imgix_options)
			->url();

	} else {

		$image_url = imgix::source('url', get_bloginfo('template_directory') . '/assets/img/fallback.jpg')
			->options($imgix_options)
			->url();

	}

?>

<div class="card card--secondary">

	<?php if ( $options->display_image === TRUE ) : ?>
		<img class="card__media <?php echo $img_class; ?>" src="<?php echo $image_url; ?>" />
	<?php endif; ?>

	<div class="card__content">

		<div class="card__title">

			<?php if ( $options->display_image === TRUE ) : ?>
				<img class="card__media <?php echo $img_class; ?>" src="<?php echo $image_url; ?>" />
			<?php endif; ?>

			<h6 class="card__heading">
				<a class="card__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h6>

		</div>

		<?php if ( $options->display_strap === TRUE ) : ?>
			<p class="card__strap">Here there will be some information about what the link contains&hellip;</p>
		<?php endif; ?>

		<p class="card__meta">
			<time class="card__date"><?php OCP::the_date(); ?></time>
			<span class="card__author">By <?php the_authors(FALSE); ?></span>
		</p>

	</div>

</div>
