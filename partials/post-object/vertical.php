<a class="post-object post-object--vertical" href="<?php the_permalink(); ?>">

	<div class="post-object__media">

		<div class="post-object__media-wrapper">

			<div class="content">

				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail('2x1_460'); ?>
				<?php else : ?>
					<img src="<?php bloginfo('template_directory'); ?>/resources/img/fallback.jpg">
				<?php endif; ?>

			</div>

		</div>

		<!-- TODO: re-implement after redesign -->
		<!-- <span class="post-object__tag-overlay post-object__tag--light"><?php the_post_type_label(); ?></span> -->

	</div>

	<div class="post-object__content">
		<p class="post-object__meta"><?php the_authors(); ?>&nbsp;&nbsp;<?php OCP::the_date(); ?></p>
		<h4><?php the_title(); ?></h4>
	</div>

</a>
