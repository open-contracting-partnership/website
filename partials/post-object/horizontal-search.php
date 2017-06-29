<?php $post_type = get_post_type(); ?>

<div class="post-object post-object--search">

	<span class="post-object__tag post-object__tag--<?php echo $post_type; ?>"><?php the_post_type_label(); ?></span>

	<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>

</div>