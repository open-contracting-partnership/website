<?php

	$options = get_partial_options($options, array(
		'type_label' => NULL
	));

	if ( $options->type_label === NULL ) {
		$options->type_label = get_post_type_label();
	}

?>

<div class="card card--featured">

	<?php

		$url = imgix::source('featured')
			->options([
				'crop' => 'faces',
				'fit' => 'crop',
				'w' => 930,
				'h' => 930 / (16 / 9),
				'fm' => 'pjpg'
			])
			->url();

	?>

	<img class="card__featured-media" src="<?php echo $url; ?>" />

	<div class="card__content">

		<?php if ( $options->type !== FALSE ) : ?>

		    <p class="card__meta">
		        <span class="card__type" data-content-type="<?php echo get_post_type(); ?>"><?php echo $options->type_label; ?></span>
		    </p>

		<?php endif; ?>

		<div class="card__title">

			<h2 class="card__heading">
				<a class="card__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

		</div>

	</div>

</div>
