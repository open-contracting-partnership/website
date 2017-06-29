<?php

	$options = get_partial_options($options, array(
		'display_image' => TRUE,
		'display_strap' => FALSE
	));

?>

<div class="card card--secondary">

	<?php if ( $options->display_image === TRUE ) : ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<img class="card__media card__media--right" src="<?php echo get_the_post_thumbnail_url(NULL, '4x3_230'); ?>" />
		<?php else : ?>
			<img class="card__media card__media--right" src="<?php bloginfo('template_directory'); ?>/assets/img/fallback.jpg" />
		<?php endif; ?>

	<?php endif; ?>

	<div class="card__content">

		<div class="card__title">

			<?php if ( $options->display_image === TRUE ) : ?>

				<?php if ( has_post_thumbnail() ) : ?>
					<img class="card__media card__media--right" src="<?php echo get_the_post_thumbnail_url(NULL, '4x3_230'); ?>" />
				<?php else : ?>
					<img class="card__media card__media--right" src="<?php bloginfo('template_directory'); ?>/assets/img/fallback.jpg" />
				<?php endif; ?>

			<?php endif; ?>

			<h6 class="card__heading">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h6>

		</div>

		<?php if ( $options->display_strap === TRUE ) : ?>
			<p class="card__strap">Here there will be some information about what the link contains&hellip;</p>
		<?php endif; ?>

		<p class="card__meta">
			<time class="card__date" datetime="2001-05-15T19:00"><?php OCP::the_date(); ?></time>
			<span class="card__author">By <?php the_authors(FALSE); ?></span>
		</p>

	</div>

</div>
