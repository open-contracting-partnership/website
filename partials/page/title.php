<?php if ( ! get_field('title_type') || get_field('title_type') === 'original' ) : ?>

	<div class="page-title">
		<h1><?php the_title(); ?></h1>
	</div>

<?php elseif ( get_field('title_type') === 'custom' ) : ?>

	<div class="page-title">
		<<?php the_field('title_level'); ?>><?php the_field('title'); ?></<?php the_field('title_level'); ?>>
	</div>

<?php endif; ?>
