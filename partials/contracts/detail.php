<?php

	$options = get_partial_options($options, array(
		'label' => '',
		'value' => ''
	));

?>

<li>

	<b><?php echo $options->label; ?>:</b>

	<?php if ( $options->value ) : ?>
		<?php echo $options->value; ?>
	<?php else : ?>
		<span class="subtle"><?php _e('n/a', 'ocp_contracts'); ?></span>
	<?php endif; ?>

</li>
