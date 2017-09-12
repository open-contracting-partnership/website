<?php

	$content = get_partial_options($options);

?>

<ul class="contract-single-details">
	<?php contract_detail('Date', $content->date); ?>
	<?php contract_detail('Supplier Name', $content->supplier_name); ?>
</ul>

<div class="figure-block-container">
	<?php contract_highlight('Amount', amount_format($content->amount)); ?>
	<?php contract_highlight('Currency', $content->currency); ?>
</div>
