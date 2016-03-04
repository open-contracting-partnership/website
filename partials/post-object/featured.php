<a class="post-object post-object--featured" href="<?php the_permalink(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail('16x9_930'); ?>
	<?php endif; ?>

	<div class="post-object__content">
		<span class="post-object__tag">Featured Blog</span>
		<h4><?php the_title(); ?></h4>
	</div>

</a>
