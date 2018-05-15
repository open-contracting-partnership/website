<?php $post_type = get_post_type(); ?>

<a class="post-object post-object--horizontal post-object--type-<?php echo $post_type; ?> / media" href="<?php the_permalink(); ?>">

	<div class="post-object__media / media__object">

		<div class="post-object__media-wrapper">

			<div class="content">

				<?php if ( post_type_supports($post_type, 'thumbnail') ) : ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail('4x3_230'); ?>
					<?php else : ?>
						<img src="<?php bloginfo('template_directory'); ?>/resources/img/fallback.jpg" alt="">
					<?php endif; ?>

				<?php else : ?>
					<svg><use xlink:href="#icon-<?php echo $post_type; ?>"></svg>
				<?php endif; ?>

			</div>

		</div>

	</div>

	<div class="post-object__content / media__body">

		<p class="post-object__meta"><?php OCP::the_date(); ?></p>
		<p class="post-object__meta">By <?php the_authors(FALSE); ?></p>

		<h4><?php the_title(); ?></h4>

	</div>

</a>
