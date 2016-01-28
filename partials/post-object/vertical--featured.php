<a class="post-object post-object--vertical post-object--light post-object--featured" href="<?php the_permalink(); ?>">

	<div class="post-object__media">

		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('16x9_690'); ?>
		<?php else : ?>
			<img src="http://placehold.it/690x388" alt="">
		<?php endif; ?>

		<div class="post-object--featured__title">

			<span class="post-object__tag">Featured <?php the_post_type_label(); ?></span>

			<div class="heading-highlight heading-highlight--dark">
				<h4><?php the_title(); ?></h4>
			</div>

		</div>

	</div>

	<div class="post-object__content">

		<div class="post-object__content-meta">
			<span class="post-object__author">By Kathryn Chen</span>
			<span class="post-object__age">3 Days ago</span>
		</div>

		<p><?php the_excerpt(); ?></p>

	</div>

</a>
