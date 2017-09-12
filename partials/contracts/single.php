<?php

	$data = get_partial_options($options)->contract;

	// fetch the phase index, based on the phases array
	$phase_index = array_search($data->phase, Contracts::$phases);

	$planning = array(
		'title' => 'Rationale',
		'description' => $data->planning_rationale,
		'amount' => $data->planning_amount,
		'currency' => $data->planning_currency
	);

	$tender = array(
		'title' => 'Description',
		'description' => $data->tender_description,
		'status' => $data->tender_status,
		'procurement_method' => $data->tender_procurement,
		'method_rationale' => $data->tender_rationale,
		'award_criteria' => $data->tender_criteria,
		'period_start' => $data->tender_start_date,
		'period_end' => $data->tender_end_date,
		'enquiries' => $data->tender_enquiries,
		'tor' => $data->tender_tor
	);

	$award = array(
		'date' => $data->award_date,
		'supplier_name' => $data->award_supplier,
		'amount' => $data->award_value,
		'currency' => $data->award_currency
	);

	$contract = array(
		'title' => $data->contract_title,
		'status' => $data->contract_status,
		'period_start' => $data->contract_start_date,
		'period_end' => $data->contract_end_date,
		'signed' => $data->contract_signed,
		'amount' => $data->contract_amount,
		'currency' => $data->contract_currency,
		'document' => $data->contract_document,
		'document_title' => $data->contract_document_title
	);

	$implementation = array(
		'milestones' => unserialize($data->implementation_milestones)
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

?>

<div class="contract-single">

	<div class="page__wrapper">

		<div class="contract-single-back">
			<a href="/contracts" class="text-button button--icon"><svg><use xlink:href="#icon-arrow-left" /></svg>Back to contracts</a>
		</div>

		<div class="contract-single__header cf">

			<div>
				<h1 class="contract-single__title"><?php echo $contract['title']; ?></h1>
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

					<li class="mobile-active <?php if ( $phase_index < 0 ) : ?>in-active<?php endif; ?>">

						<a
							href="#planning"
							data-section="planning"
							class="number-heading number-heading--small number-heading--active"
							><span>1</span> Planning</a>

					</li>

					<li <?php if ( $phase_index < 1 ) : ?>class="in-active"<?php endif; ?>>

						<a
							href="#tender"
							data-section="tender"
							class="number-heading number-heading--small"
							><span>2</span> Tender</a>

					</li>

					<li <?php if ( $phase_index < 2 ) : ?>class="in-active"<?php endif; ?>>

						<a
							href="#award"
							data-section="award"
							class="number-heading number-heading--small"
							><span>3</span> Award</a>

					</li>

					<li <?php if ( $phase_index < 3 ) : ?>class="in-active"<?php endif; ?>>

						<a
							href="#contract"
							data-section="contract"
							class="number-heading number-heading--small"
							><span>4</span> Contract</a>

					</li>

					<li <?php if ( $phase_index < 4 ) : ?>class="in-active"<?php endif; ?>>

						<a
							href="#implementation"
							data-section="implementation"
							class="number-heading number-heading--small"
							><span>5</span> Implementation</a>

					</li>

				</ol>

				<a
					href="#"
					data-direction="next"
					class="contract-paginate / text-button button--icon button--icon--reverse"
					>Next<svg><use xlink:href="#icon-arrow-right" /></svg></a>

			</aside>

			<article class="page-content cf">

				<section id="planning" class="contract-single-section <?php if ( $phase_index < 0 ) : ?>in-active<?php endif; ?>">

					<h2 class="number-heading"><span>1</span> Planning</h2>

					<h3 class="beta medium"><?php echo $planning['title']; ?></h3>

					<p><?php echo $planning['description']; ?></p>

					<div class="figure-block-container">

						<div class="figure-block">
							<span>Amount</span>
							<span class="figure-block__figure"><?php echo amount_format($planning['amount']); ?></span>
						</div>

						<div class="figure-block">
							<span>Currency</span>
							<span class="figure-block__figure"><?php echo $planning['currency']; ?></span>
						</div>

					</div>

				</section>

				<section id="tender" class="contract-single-section <?php if ( $phase_index < 1 ) : ?>in-active<?php endif; ?>">

					<h2 class="number-heading"><span>2</span> Tender</h2>

					<h3 class="medium beta"><?php echo $tender['title']; ?></h3>

					<p><?php echo $tender['description']; ?></p>

					<ul class="contract-single-details">
						<li><b>Status:</b> <?php echo $tender['status']; ?></li>
						<li><b>Procurement Method:</b> <?php echo $tender['procurement_method']; ?></li>
						<li><b>Method Rationale:</b> <?php echo $tender['method_rationale']; ?></li>
						<li><b>Award Criteria:</b> <?php echo $tender['award_criteria']; ?></li>
						<li><b>Tender Period:</b> <?php echo date_period($tender['period_start'], $tender['period_end']); ?></li>
						<li><b>Enquiries:</b> <?php echo $tender['enquiries']; ?></li>
					</ul>

					<?php if ( $tender['tor'] ) : ?>
						<a href="<?php echo $tender['tor']; ?>">Terms of reference</a>
					<?php endif; ?>

				</section>

				<section id="award" class="contract-single-section <?php if ( $phase_index < 2 ) : ?>in-active<?php endif; ?>">

					<h2 class="number-heading"><span>3</span> Award</h2>

					<ul class="contract-single-details">
						<li><b>Date:</b> <?php echo $award['date']; ?></li>
						<li><b>Supplier Name:</b> <?php echo $award['supplier_name']; ?></li>
					</ul>

					<div class="figure-block-container">

						<div class="figure-block">
							<span>Amount</span>
							<span class="figure-block__figure"><?php echo amount_format($award['amount']); ?></span>
						</div>

						<div class="figure-block">
							<span>Currency</span>
							<span class="figure-block__figure"><?php echo $award['currency']; ?></span>
						</div>

					</div>

				</section>

				<section id="contract" class="contract-single-section <?php if ( $phase_index < 3 ) : ?>in-active<?php endif; ?>">

					<h2 class="number-heading"><span>4</span> Contract</h2>

					<ul class="contract-single-details">
						<li><b>Title:</b> <?php echo $contract['title']; ?></li>
						<li><b>Status:</b> <?php echo $contract['status']; ?></li>
						<li><b>Period:</b> <?php echo date_period($contract['period_start'], $contract['period_end']); ?></li>
						<li><b>Signed:</b> <?php echo $contract['signed']; ?></li>
					</ul>

					<div class="figure-block-container">

						<div class="figure-block">
							<span>Amount</span>
							<span class="figure-block__figure"><?php echo amount_format($contract['amount']); ?></span>
						</div>

						<div class="figure-block">
							<span>Currency</span>
							<span class="figure-block__figure"><?php echo $contract['currency']; ?></span>
						</div>

					</div>

					<?php if ( $contract['document'] ) : ?>
						<a href="<?php echo $contract['document']; ?>"><?php echo $contract['document_title']; ?></a>
					<?php endif; ?>

				</section>

				<section id="implementation" class="contract-single-section <?php if ( $phase_index < 4 ) : ?>in-active<?php endif; ?>">

					<h2 class="number-heading"><span>5</span> Implementation</h2>

					<?php foreach ( $implementation['milestones'] as $milestone ) : ?>

						<ul class="contract-single-details">
							<li><b>Title:</b> <?php echo $milestone['title']; ?></li>
							<li><b>Status:</b> <?php echo $milestone['status']; ?></li>
						</ul>

					<?php endforeach; ?>

				</section>

			</article>

		</div>

	</div>

</div>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/libs/waypoint.js"></script>
