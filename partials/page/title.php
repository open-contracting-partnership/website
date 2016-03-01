<?php

	$type = get_field('title_type');

	// don't continue if this page has no title
	if ( get_field('title_type') === 'none' ) {
		return;
	}

	$title = $type === 'default' ? get_the_title() : get_field('title');
	$class = $type === 'default' ? '' : get_field('title_level');

?>

<div class="page-title">

	<h1 class="<?php echo $class ?>"><?php echo $title; ?></h1>

	<?php if ( $stapline = get_field('strapline') ) : ?>
		<div class="strapline"><?php echo $stapline; ?></div>
	<?php endif; ?>

</div>
