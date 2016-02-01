<a class="post-object post-object--horizontal / media" href="<?php the_permalink(); ?>">

	<div class="post-object__media / media__object">
		<img src="http://placehold.it/122x154" alt="">
	</div>

	<div class="post-object__content / media__body">

		<h4><?php the_title(); ?></h4>

		<p>
			By <?php the_authors(FALSE); ?>

			<?php if ( get_comments_number() > 0 ) : ?>
				<span><?php echo get_comments_number(); ?></span>
			<?php endif; ?>

		</p>

	</div>

</a>
