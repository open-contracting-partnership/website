<?php

	$content = get_partial_options($options);

?>

<h3 class="medium beta">Description</h3>

<?php if ( $content->description ) : ?>
	<p><?php echo $content->description; ?></p>
<?php else : ?>
	<p><span class="subtle">No description</span></p>
<?php endif; ?>

<ul class="contract-single-details">
	<?php contract_detail('Status', $content->status); ?>
	<?php contract_detail('Procurement Method', $content->procurement_method); ?>
	<?php contract_detail('Method Rationale', $content->method_rationale); ?>
	<?php contract_detail('Award Criteria', $content->award_criteria); ?>
	<?php contract_detail('Tender Period', date_period($content->period_start, $content->period_end)); ?>
	<?php contract_detail('Enquiries', $content->enquiries); ?>
</ul>

<?php if ( $content->tor ) : ?>
	<a href="<?php echo $content->tor; ?>">Terms of reference</a>
<?php endif; ?>
