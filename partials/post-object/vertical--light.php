<a class="post-object post-object--vertical post-object--light" href="<?php the_permalink(); ?>">

	<div class="post-object__media">

		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('2x1_460'); ?>
		<?php else : ?>
			<img src="http://placehold.it/460x230" alt="">
		<?php endif; ?>

		<span class="post-object__tag"><?php the_post_type_label(); ?></span>

	</div>

	<div class="post-object__content">

		<div class="post-object__content-meta">
			<span class="post-object__author">By Theresa Stevens</span>
			<span class="post-object__age">1H ago</span>
			<span class="post-object__comment-count">21</span>
		</div>

		<h4><?php the_title(); ?></h4>

	</div>

</a>
