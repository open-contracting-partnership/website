<a data-type="<?php echo get_post_type(); ?>" href="<?php the_permalink(); ?>" class="post-object post-object--panel / homepage-filter__item homepage-filter__<?php echo get_post_type(); ?>">
	<div class="post-object--panel__tag"><?php the_post_type_label(); ?></div>
	<div class="post-object--panel__meta"><?php the_authors(); ?><span><?php the_time(get_option('date_format')); ?></span></div>
	<h4><?php the_title(); ?></h4>
</a>
