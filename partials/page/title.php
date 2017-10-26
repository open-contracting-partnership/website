<div class="page-title">

	<h1><?php the_title(); ?></h1>

	<?php if ( $stapline = get_field('strapline') ) : ?>
		<h2 class="delta strapline"><?php echo $stapline; ?></h2>
	<?php endif; ?>

	<?php if ( get_post_type() === 'post' ) : ?>

		<div class="page-meta">
	 		<p><datetime><?php the_date(); ?></datetime></p>
			<p><?php _e('By', 'ocp'); ?> <?php the_authors(TRUE); ?></p>
		</div>

	<?php endif; ?>

	<?php if ( get_field('introduction') ) : ?>

		<blockquote class="worldwide-intro">
			<?php the_field('introduction'); ?>
		</blockquote>

	<?php endif; ?>

</div>
