<?php

	use \App\Media;
	use \App\Imgix;

	$options = get_partial_options($options, [
		'title' => get_the_title(),
		'intro' => get_the_excerpt(),
		'image' => Media::get_attachment_image_src('full')[0]
	]);

	if ( $options->image ) {

		$options->image = Imgix::source('url', $options->image)
			->options([
				'crop' => 'faces',
				'fit' => 'crop',
				'w' => 1490,
				'h' => 1490 / (3 / 2),
				'fm' => 'pjpg'
			])
			->url();

	}

?>

<div class="card card--image">

	<div class="card__image">

		<img src="<?php echo $options->image; ?>" />

		<div class="card__image-overlay">

			<a class="card__title-link" href="#">
				<h2 class="card__title"><?php echo prevent_widow($options->title); ?></h2>
			</a>

			<div class="card__intro">
				<p><?php echo prevent_widow($options->intro); ?></p>
			</div>

		</div>

	</div>

</div>
