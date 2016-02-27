<a class="post-object post-object--horizontal / media" href="<?php the_permalink(); ?>">

	<div class="post-object__media / media__object">

		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('4x3_230'); ?>
		<?php else : ?>
			<img src="http://placehold.it/230x173" alt="">
		<?php endif; ?>

	</div>

	<div class="post-object__content / media__body">

		<p class="post-object__meta"><?php the_time(get_option('date_format')); ?></p>
		<p class="post-object__meta">By <?php the_authors(FALSE); ?></p>

		<h4><?php the_title(); ?></h4>

	</div>

</a>
