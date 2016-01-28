<a href="<?php the_permalink(); ?>" class="post-object post-object--vertical">

	<div class="post-object__media">

		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('2x1_460'); ?>
		<?php else : ?>
			<img src="http://placehold.it/460x230" alt="">
		<?php endif; ?>

		<span class="post-object__tag">Projects</span>

	</div>

	<div class="post-object__content">
		<h4><?php the_title(); ?></h4>
		<p>Open is part of our name and game at the Open Contracting Partnership. This means, open is at the core of our institution. It is our mission. It is one of our core values. If we want public procurement to be open, we have to be open ourselves.</p>
	</div>

</a>
