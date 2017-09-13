<?php

	$content = get_partial_options($options);

?>

<?php if ( $content->milestones ) : ?>

	<?php foreach ( $content->milestones as $milestone ) : ?>

		<ul class="contract-single-details">
			<?php contract_detail('Title', $milestone['title']); ?>
			<?php contract_detail('Status', $milestone['status']); ?>
		</ul>

	<?php endforeach; ?>

<?php else : ?>

	<span class="subtle"><?php _e('No milestones', 'ocp_contracts'); ?></span>

<?php endif; ?>
