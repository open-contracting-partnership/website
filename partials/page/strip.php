<section class="page-strip">

	<div class="wrapper">

		<?php if ( $image = get_sub_field('image') ) : ?>

			<div class="page-strip__media">
				<img src="<?php echo $image['sizes']['large']; ?>" alt="" />
			</div>

		<?php endif; ?>

		<div class="page-strip__content">
			<h3><?php the_sub_field('title'); ?></h3>
			<?php the_sub_field('content'); ?>
		</div>

	</div>

</section>
