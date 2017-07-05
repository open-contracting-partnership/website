<div class="page-title">

	<h1><?php the_title(); ?></h1>

	<?php if ( $stapline = get_field('strapline') ) : ?>
		<h2 class="delta strapline"><?php echo $stapline; ?></h2>
	<?php endif; ?>

</div>
