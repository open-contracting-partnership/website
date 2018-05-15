<?php

	$options = get_partial_options($options, array(
		'display_image' => TRUE,
		'display_type' => FALSE,
		'meta_alt' => FALSE
	));

?>

<div class="card card--primary">

	<?php if ( $options->display_image === TRUE ) : ?>

		<div class="card__header">

			<?php if ( has_post_thumbnail() ) : ?>

				<?php

					$url = imgix::source('featured')
						->options([
							'crop' => 'faces',
							'fit' => 'crop',
							'w' => 768,
							'h' => 768 / (21 / 9),
							'fm' => 'pjpg'
						])
						->url();

				?>

				<img class="card__featured-media" src="<?php echo $url; ?>" />

			<?php else : ?>
				<img class="card__featured-media" src="<?php bloginfo('template_directory'); ?>/resources/img/fallback.jpg" />
			<?php endif; ?>

		</div>

	<?php endif; ?>

	<div class="card__content">

		<div class="card__title">

			<h6 class="card__heading">
				<a class="card__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h6>

		</div>

		<p class="card__meta <?php if ( $options->meta_alt ) : ?>card__meta--alt<?php endif; ?>">

			<?php if ( $options->display_type ) : ?>
				<span class="card__type" data-content-type="<?php get_post_type(); ?>"><?php the_post_type_label(); ?></span>
			<?php endif; ?>

			<time class="card__date"><?php OCP::the_date(); ?></time>

			<?php if ( $author = get_authors(FALSE) ) : ?>
				<span class="card__author">By <?php echo $author; ?></span>
			<?php endif; ?>

		</p>

	</div>

</div>
