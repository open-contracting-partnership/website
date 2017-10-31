<?php

	$content = get_partial_options($options);

?>

<ul class="contract-single-details">
	<?php contract_detail('Title', $content->title); ?>
	<?php contract_detail('Status', $content->status); ?>
	<?php contract_detail('Period', date_period($content->period_start, $content->period_end)); ?>
	<?php contract_detail('Signed', $content->signed); ?>
</ul>

<div class="figure-block-container">
	<?php contract_highlight('Amount', implode(' ', [amount_format($content->amount), $content->currency])); ?>
</div>

<?php if ( $content->document ) : ?>
	<a href="<?php echo $content->document; ?>"><?php echo $content->document_title; ?></a>
<?php endif; ?>
