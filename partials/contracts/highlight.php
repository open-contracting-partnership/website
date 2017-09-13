<?php

	$options = get_partial_options($options, array(
		'label' => '',
		'value' => ''
	));

?>

<div class="figure-block">

	<div><?php echo $options->label; ?></div>
	<div class="figure-block__figure">

		<?php if ( $options->value ) : ?>
			<?php echo $options->value; ?>
		<?php else : ?>
			<span class="subtle"><?php _e('n/a', 'ocp_contracts'); ?></span>
		<?php endif; ?>

	</div>

</div>
