<div class="page-title">

	<?php if ( in_array(get_post_type(), ['post', 'news']) ) : ?>

		<div class="band band--thin">

			<a href="<?php echo get_post_type_archive_link('post'); ?>" class="text-button button--icon">
				<svg><use xlink:href="#icon-arrow-left" /></svg>
				<?php _e('Back to latest', 'ocp'); ?>
			</a>

		</div>

		<div>
			<span class="card__type" data-content-type="<?php echo get_post_type(); ?>"><?php the_post_type_label(); ?></span>
		</div>

	<?php endif; ?>

	<h1><?php the_title(); ?></h1>

	<?php if ( $stapline = get_field('strapline') ) : ?>
		<h2 class="delta strapline"><?php echo $stapline; ?></h2>
	<?php endif; ?>

	<?php if ( in_array(get_post_type(), ['post', 'news']) ) : ?>

		<div class="page-meta">

	 		<p><datetime><?php the_date(); ?></datetime></p>

			<?php if ( get_authors() ) : ?>
				<p><?php _e('By', 'ocp'); ?> <?php the_authors(TRUE); ?></p>
			<?php endif; ?>

		</div>

	<?php endif; ?>

	<?php if ( get_field('introduction') ) : ?>

		<blockquote class="worldwide-intro">
			<?php the_field('introduction'); ?>
		</blockquote>

	<?php endif; ?>

</div>
