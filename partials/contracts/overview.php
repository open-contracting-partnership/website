<?php

use \App\Contracts;

the_post();

?>

<div class="page__wrapper / contracts-overview">

	<div class="contracts-title cf">
		<?php get_partial('page', 'title'); ?>
	</div>

	<article class="page-content">

		<div class="select-menu">

			<label class="visuallyhidden"></label>

			<select name="phase" class="">

				<option value="" selected="selected">Phase&hellip;</option>

				<?php foreach ( Contracts::$phases as $phase => $label ) : ?>
					<option value="<?php echo $phase; ?>"><?php echo $label; ?></option>
				<?php endforeach; ?>

			</select>

		</div>

		<?php if ( current_user_can('administrator') ) : ?>

			<form action="/contracts/" method="POST" class="pull-left">
				<input type="hidden" name="reset_contracts" value="true">
				<button class="button button--dark" style="margin-right: 1em">Admin: Update Contract Data</button>
			</form>

		<?php endif; ?>

		<a href="/wp-content/uploads/contracts/contracts.csv" class="button button--dark" download>Download CSV</a>
		<a href="/wp-content/uploads/contracts/contracts.json" class="button button--dark" download>Download JSON</a>

	</article>

	<?php $contracts = Contracts::get_contracts(); ?>

	<?php if ( $contracts ) : ?>

		<section class="table-wrap">

			<table class="contracts-table">

				<thead>

					<tr>
						<th>Phase</th>
						<th>Title</th>
						<th>Supplier</th>
						<th>Date</th>
						<th>Amount</th>
						<th>Status</th>
					</tr>

				</thead>

				<tbody>

					<?php foreach ( $contracts as $contract ) : ?>

						<?php $currency = $contract->contract_currency ? ' ' . $contract->contract_currency : '' ?>

						<tr data-phase="<?php echo $contract->phase; ?>">

							<td>

								<div class="contracts-table__phase">
									<span class="number-heading__number"><?php echo Contracts::phase_number($contract->phase); ?></span>
									<span><?php echo $contract->phase ? Contracts::$phases[$contract->phase] : '-' ?></span>
								</div>

							</td>

							<td>

								<a href="/contracts/<?php echo $contract->ocid; ?>">
									<?php echo $contract->contract_title ? $contract->contract_title : '-' ?>
								</a>

							</td>

							<td><?php echo $contract->supplier_name ? $contract->supplier_name : '-'; ?></td>

							<td>
								<?php

								echo $contract->contract_start_date ? $contract->contract_start_date : '-';
								echo $contract->contract_start_date && $contract->contract_end_date ? ' -<br />' : '';
								echo $contract->contract_end_date ? $contract->contract_end_date : '';

								?>
							</td>

							<td data-value="<?php echo $contract->contract_amount; ?>"><?php echo $contract->contract_amount ? number_format($contract->contract_amount) . $currency : '-' ?></td>

							<td><?php echo $contract->contract_status ? ucwords($contract->contract_status) : '-' ?></td>

						</tr>

					<?php endforeach; ?>

				</tbody>

			</table>

		</section>

	<?php endif; ?>

</div> <!-- / .page__wrapper -->
