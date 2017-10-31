<section class="page-strip">

	<div class="wrapper">

		<?php if ( $image = get_sub_field('image') ) : ?>

			<div class="page-strip__media">
				<img src="<?php echo $image['sizes']['large']; ?>" alt="" />
			</div>

		<?php endif; ?>

		<div class="page-strip__wrapper">

			<h2 class="page-strip__title"><?php the_sub_field('title'); ?></h2>

			<div class="page-strip__content">
				<?php the_sub_field('content'); ?>
			</div>

		</div>

	</div>

</section>
