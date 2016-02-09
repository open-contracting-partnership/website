<div class="homepage-filter__post">

	<a href="<?php the_permalink(); ?>" class="post-object post-object--vertical post-object--blog">

		<div class="post-object__media">

			<?php the_post_thumbnail('2x1_460'); ?>

			<div class="post-object--blog__title">
				<span class="post-object__tag">Blog</span>
				<h4><?php the_title(); ?></h4>
			</div>

		</div>

		<div class="post-object__content">
			<p>By <?php the_authors(); ?></p>
		</div>

	</a>

</div>
