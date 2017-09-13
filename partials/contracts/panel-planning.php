<?php

	$content = get_partial_options($options);

?>

<h3 class="beta medium">Rationale</h3>

<?php if ( $content->description ) : ?>
	<p><?php echo $content->description; ?></p>
<?php else : ?>
	<p><span class="subtle">No rationale</span></p>
<?php endif; ?>

<div class="figure-block-container">
	<?php contract_highlight('Amount', amount_format($content->amount)); ?>
	<?php contract_highlight('Currency', $content->currency); ?>
</div>
