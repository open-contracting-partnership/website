<?php

	$data = get_partial_options($options)->contract;

	$phases = Contracts::get_phases();
	$phase_state = true;

	foreach ( $phases as $phase => $phase_data ) {

		$phases[$phase] = $phase_state;

		if ( $data->contract_phase == $phase ) {
			$phase_state = false;
		}

	}

	$planning = array(
		'title' => 'Rationale',
		'description' => $data->contract_rationale,
		'amount' => $data->contract_amount,
		'currency' => $data->contract_currency
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
		'enquiries' => $data->tender_enquiries
		// 'document_tor' => $data->
	);

	$award = array(
		'date_start' => $data->award_start,
		'date_end' => $data->award_end,
		'supplier_name' => $data->award_supplier,
		'amount' => $data->award_value,
		'currency' => $data->award_currency
	);

	$contract = array(
		'title' => $data->contract_title,
		'period_start' => $data->contract_start_date,
		'period_end' => $data->contract_end_date,
		'contract_title' => $data->contract_title,
		'status' => $data->contract_status,
		'signed' => $data->contract_phase,
		'amount' => $data->contract_amount,
		'currency' => $data->contract_currency
		// 'document_tor' => $data->contract_
	);

	$implementation = array();

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
					<li class="mobile-active <?php if ( ! $phases['planning'] ) : ?>in-active<?php endif; ?>">
						<a
							href="#planning"
							data-section="planning"
							class="number-heading number-heading--small number-heading--active"
							><span>1</span> Planning</a>
					</li>
					<li <?php if ( ! $phases['tender'] ) : ?>class="in-active"<?php endif; ?>>
						<a
							href="#tender"
							data-section="tender"
							class="number-heading number-heading--small"
							><span>2</span> Tender</a>
					</li>
					<li <?php if ( ! $phases['awards'] ) : ?>class="in-active"<?php endif; ?>>
						<a
							href="#award"
							data-section="award"
							class="number-heading number-heading--small"
							><span>3</span> Award</a>
					</li>
					<li <?php if ( ! $phases['contracts'] ) : ?>class="in-active"<?php endif; ?>>
						<a
							href="#contract"
							data-section="contract"
							class="number-heading number-heading--small"
							><span>4</span> Contract</a>
					</li>
					<li <?php if ( ! $phases['implementation'] ) : ?>class="in-active"<?php endif; ?>>
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

				<section id="planning" class="contract-single-section <?php if ( ! $phases['planning'] ) : ?>in-active<?php endif; ?>">

					<h2 class="number-heading"><span>1</span> Planning</h2>

					<h3 class="beta medium"><?php echo $planning['title']; ?></h3>

					<p><?php echo $planning['description']; ?></p>

					<div class="figure-block-container">

						<div class="figure-block">
							<span>Amount</span>
							<span class="figure-block__figure"><?php echo $planning['amount']; ?></span>
						</div>

						<div class="figure-block">
							<span>Currency</span>
							<span class="figure-block__figure"><?php echo $planning['currency']; ?></span>
						</div>

					</div>

				</section>

				<section id="tender" class="contract-single-section <?php if ( ! $phases['tender'] ) : ?>in-active<?php endif; ?>">

					<h2 class="number-heading"><span>2</span> Tender</h2>

					<h3 class="medium beta"><?php echo $tender['title']; ?></h3>

					<p><?php echo $tender['description']; ?></p>

					<ul class="contract-single-details">
						<li><b>Status:</b> <?php echo $tender['status']; ?></li>
						<li><b>Procurement Method:</b> <?php echo $tender['procurement_method']; ?></li>
						<li><b>Method Rationale:</b> <?php echo $tender['method_rationale']; ?></li>
						<li><b>Award Criteria:</b> <?php echo $tender['award_criteria']; ?></li>
						<li><b>Tender Period:</b> <?php echo $tender['period_start'] . ' - ' . $tender['period_end']; ?></li>
						<li><b>Enquiries:</b> <?php echo $tender['enquiries']; ?></li>
					</ul>

					<a href="#">document tor download</a>

				</section>

				<section id="award" class="contract-single-section <?php if ( ! $phases['awards'] ) : ?>in-active<?php endif; ?>">

					<h2 class="number-heading"><span>3</span> Award</h2>

					<ul class="contract-single-details">
						<li><b>Date:</b> <?php echo $award['date_start'] . ' - ' . $award['date_end']; ?></li>
						<li><b>Supplier Name:</b> <?php echo $award['supplier_name']; ?></li>
					</ul>

					<div class="figure-block-container">

						<div class="figure-block">
							<span>Amount</span>
							<span class="figure-block__figure"><?php echo $award['amount']; ?></span>
						</div>

						<div class="figure-block">
							<span>Currency</span>
							<span class="figure-block__figure"><?php echo $award['currency']; ?></span>
						</div>

					</div>

				</section>

				<section id="contract" class="contract-single-section <?php if ( ! $phases['contracts'] ) : ?>in-active<?php endif; ?>">

					<h2 class="number-heading"><span>4</span> Contract</h2>

					<ul class="contract-single-details">
						<li><b>Title:</b> <?php echo $contract['title']; ?></li>
						<li><b>Period (Start / End):</b> <?php echo $contract['period_start'] . ' - ' . $contract['period_end']; ?></li>
						<li><b>Contract Title:</b> <?php echo $contract['contract_title']; ?></li>
						<li><b>Status:</b> <?php echo $contract['status']; ?></li>
						<li><b>Signed:</b> <?php echo $contract['signed']; ?></li>
					</ul>

					<div class="figure-block-container">

						<div class="figure-block">
							<span>Amount</span>
							<span class="figure-block__figure"><?php echo $contract['amount']; ?></span>
						</div>

						<div class="figure-block">
							<span>Currency</span>
							<span class="figure-block__figure"><?php echo $contract['currency']; ?></span>
						</div>

					</div>

					<a href="#">document tor download</a>

				</section>

				<section id="implementation" class="contract-single-section <?php if ( ! $phases['implementation'] ) : ?>in-active<?php endif; ?>">

					<h2 class="number-heading"><span>5</span> Implementation</h2>

				</section>

			</article>

		</div>

	</div>

</div>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/libs/waypoint.js"></script>
