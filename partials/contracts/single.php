<?php

	$data = get_partial_options($options)->contract;

	// fetch the phase index, based on the phases array
	$phase_index = array_search($data->phase, array_keys(Contracts::$phases));

	$content = array(
		'planning' => array(
			'description' => $data->planning_rationale,
			'amount' => $data->planning_amount,
			'currency' => $data->planning_currency
		),
		'tender' => array(
			'description' => $data->tender_description,
			'status' => $data->tender_status,
			'procurement_method' => $data->tender_procurement,
			'method_rationale' => $data->tender_rationale,
			'award_criteria' => $data->tender_criteria,
			'period_start' => $data->tender_start_date,
			'period_end' => $data->tender_end_date,
			'enquiries' => $data->tender_enquiries,
			'tor' => $data->tender_tor
		),
		'award' => array(
			'date' => $data->award_date,
			'supplier_name' => $data->award_supplier,
			'amount' => $data->award_value,
			'currency' => $data->award_currency
		),
		'contract' => array(
			'title' => $data->contract_title,
			'status' => $data->contract_status,
			'period_start' => $data->contract_start_date,
			'period_end' => $data->contract_end_date,
			'signed' => $data->contract_signed,
			'amount' => $data->contract_amount,
			'currency' => $data->contract_currency,
			'document' => $data->contract_document,
			'document_title' => $data->contract_document_title
		),
		'implementation' => array(
			'milestones' => unserialize($data->implementation_milestones)
		)
	);

	function amount_format($amount) {

		if ( ! $amount ) {
			return;
		}

		return number_format($amount);

	}

	function date_period($start, $end) {

		$date_period = array();

		if ( $start ) {
			$date_period[] = $start;
		}

		if ( $end ) {
			$date_period[] = $end;
		}

		return implode(' - ', $date_period);

	}

	function contract_detail($label, $value) {

		get_partial('contracts', 'detail', [
			'label' => $label,
			'value' => $value,
		]);

	}
	function contract_highlight($label, $value) {

		get_partial('contracts', 'highlight', [
			'label' => $label,
			'value' => $value,
		]);

	}

?>

<div class="contract-single">

	<div class="page__wrapper">

		<div class="contract-single-back">
			<a href="/contracts" class="text-button button--icon"><svg><use xlink:href="#icon-arrow-left" /></svg>Back to contracts</a>
		</div>

		<div class="contract-single__header cf">

			<div>
				<h1 class="contract-single__title"><?php echo $content['contract']['title']; ?></h1>
				<p class="contract-id"><?php echo $data->ocid; ?></p>
			</div>

		</div>

		<div class="contract-single__main">

			<aside class="sidebar page-sidebar">

				<a
					href="#"
					data-direction="prev"
					class="contract-paginate / text-button button--icon"
					><svg><use xlink:href="#icon-arrow-left" /></svg>Prev</a>

				<ol class="plain contract-sidebar-nav">

					<?php foreach ( Contracts::$phases as $key => $label ) : ?>

						<?php $index = array_search($key, array_keys(Contracts::$phases)); ?>

						<li class="<?php if ( $phase_index < $index ) : ?>in-active<?php endif; ?>">

							<a
								href="#<?php echo $key; ?>"
								data-section="<?php echo $key; ?>"
								class="number-heading number-heading--small number-heading--active"
								><span class="number-heading__number"><?php echo $index + 1; ?></span> <?php echo $label; ?></a>

						</li>

					<?php endforeach; ?>

					<script>document.querySelector('.contract-sidebar-nav li:first-child').classList.add('mobile-active');</script>

				</ol>

				<a
					href="#"
					data-direction="next"
					class="contract-paginate / text-button button--icon button--icon--reverse"
					>Next<svg><use xlink:href="#icon-arrow-right" /></svg></a>

			</aside>

			<article class="page-content cf">

				<?php foreach ( Contracts::$phases as $key => $label ) : ?>

					<?php $index = array_search($key, array_keys(Contracts::$phases)); ?>

					<section id="<?php echo $key; ?>" class="contract-single-section <?php if ( $phase_index < $index ) : ?>in-active<?php endif; ?>">

						<h2 class="number-heading"><span class="number-heading__number"><?php echo $index +1; ?></span> <?php echo $label; ?></h2>

						<?php get_partial('contracts', 'panel-' . $key, $content[$key]); ?>

					</section>

				<?php endforeach; ?>

			</article>

		</div>

	</div>

</div>
