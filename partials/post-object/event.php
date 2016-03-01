<div class="post-object post-object--event">

	<div class="post-object__media">
		<time><?php the_time('j'); ?><span><?php the_time('S'); ?></span><em><?php the_time('M'); ?></em></time>
	</div>

	<div class="post-object__content">
		<h4><?php the_title(); ?></h4>
	</div>

	<div class="post-object__link">
		<a href="<?php the_permalink(); ?>">Details</a>
	</div>

</div>
