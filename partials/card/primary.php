<?php

	use \App\Media;
	use \App\Imgix;

	$options = get_partial_options($options, [
		'title' => get_the_title(),
		'intro' => get_the_excerpt(),
		'image' => Media::get_attachment_image_src('full')[0],
		'meta' => get_the_author_meta('display_name'),
		'permalink' => get_the_permalink()
	]);

	if ( $options->image ) {

		$options->image = Imgix::source('url', $options->image)
			->options([
				'crop' => 'faces',
				'fit' => 'crop',
				'w' => 600,
				'h' => 600 / (16 / 9),
				'fm' => 'pjpg'
			])
			->url();

	}

?>

<div class="card card--primary">

	<div class="card__image">

		<img src="<?php echo $options->image; ?>" />

		<div class="card__image-overlay">
			<div class="card__tag">Blog</div>
		</div>

	</div>

	<div class="card__main">

		<a class="card__title-link" href="<?php echo $options->permalink; ?>">
			<h2 class="card__title"><?php echo prevent_widow($options->title); ?></h2>
		</a>

		<div class="card__footer">

			<?php if ( $options->meta ) : ?>

				<div class="card__meta">
					<?php echo $options->meta; ?>
				</div>

			<?php endif; ?>

			<?php if ( $options->permalink ) : ?>

				<div class="card__cta">

					<a class="arrow-link" href="<?php echo $options->permalink; ?>">
						<svg class="arrow-link__icon"><use xlink:href="#icon-arrow-circle"></use></svg>
						<span class="arrow-link__label">Read</span>
					</a>

				</div>

			<?php endif; ?>

		</div>

	</div>

</div>
