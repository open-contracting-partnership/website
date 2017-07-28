<?php

	$options = get_partial_options($options, array(
		'display_image' => TRUE
	));

?>

<div class="card card--primary">

	<?php if ( $options->display_image === TRUE ) : ?>

		<div class="card__header">

			<?php if ( has_post_thumbnail() ) : ?>
				<img class="card__featured-media" src="<?php echo get_the_post_thumbnail_url(NULL, '21x9_768'); ?>" />
			<?php else : ?>
				<img class="card__featured-media" src="<?php bloginfo('template_directory'); ?>/assets/img/fallback.jpg" />
			<?php endif; ?>

		</div>

	<?php endif; ?>

    <div class="card__content">

        <div class="card__title">

            <h6 class="card__heading">
                <a class="card__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h6>

        </div>

        <p class="card__meta">
			<time class="card__date"><?php OCP::the_date(); ?></time>
			<span class="card__author">By <?php the_authors(FALSE); ?></span>
        </p>

    </div>

</div>
