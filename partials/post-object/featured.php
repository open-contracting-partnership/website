<a class="post-object post-object--featured" href="<?php the_permalink(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail('16x9_930'); ?>
	<?php endif; ?>

	<div class="post-object__content">
		<span class="post-object__tag-overlay">Featured Blog</span>
		<h4><span><?php the_title(); ?></span></h4>
		<span class="post-object__meta"><?php the_authors(); ?>&nbsp;&nbsp;<?php the_time(get_option('date_format')); ?></span>
	</div>

</a>
