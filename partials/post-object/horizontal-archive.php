<?php $post_type = get_post_type(); ?>

<div class="post-object post-object--archive post-object--archive-<?php echo $post_type; ?>">

	<div class="post-object__media">
		<svg><use xlink:href="#icon-<?php echo $post_type; ?>"></svg>
	</div>

	<div class="post-object__content">

		<div>
			<span class="post-object__tag post-object__tag--<?php echo $post_type; ?>"><?php the_post_type_label(); ?></span>
			<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
		</div>

		<div class="post-object__meta">
			<span><?php the_authors(FALSE); ?></span>
			<time><?php the_time(get_option('date_format')); ?></time>
		</div>

	</div>

</div>
