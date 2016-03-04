<div class="post-object post-object--basic">

	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

	<p class="post-object__meta">

		<?php if ( $authors = get_authors() ) : ?>
			<?php echo $authors; ?>&nbsp;&nbsp;
		<?php endif; ?>

		<?php OCP::the_date(); ?>

	</p>

</div>
