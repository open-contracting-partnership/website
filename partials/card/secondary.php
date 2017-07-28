<?php

	$options = get_partial_options($options, array(
		'display_image' => TRUE,
		'display_strap' => FALSE,
		'image_align_right' => FALSE
	));

	$img_class = $options->image_align_right ? 'card__media--right' : '';

?>

<div class="card card--secondary">

	<?php if ( $options->display_image === TRUE ) : ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<img class="card__media <?php echo $img_class; ?>" src="<?php echo get_the_post_thumbnail_url(NULL, '4x3_230'); ?>" />
		<?php else : ?>
			<img class="card__media <?php echo $img_class; ?>" src="<?php bloginfo('template_directory'); ?>/assets/img/fallback.jpg" />
		<?php endif; ?>

	<?php endif; ?>

	<div class="card__content">

		<div class="card__title">

			<?php if ( $options->display_image === TRUE ) : ?>

				<?php if ( has_post_thumbnail() ) : ?>
					<img class="card__media <?php echo $img_class; ?>" src="<?php echo get_the_post_thumbnail_url(NULL, '4x3_230'); ?>" />
				<?php else : ?>
					<img class="card__media <?php echo $img_class; ?>" src="<?php bloginfo('template_directory'); ?>/assets/img/fallback.jpg" />
				<?php endif; ?>

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
