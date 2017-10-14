<?php the_post(); ?>

<div class="page__wrapper">

	<div class="contracts-title cf">
		<?php get_partial('page', 'title'); ?>
	</div>

	<article class="page-content cf">

		<div class="button-group pull-right">

			<?php if ( current_user_can('administrator') ) : ?>

				<form action="/contracts/" method="POST" class="pull-left">
					<input type="hidden" name="reset_contracts" value="true">
					<button class="button button--dark" style="margin-right: 1em">Admin: Update Contract Data</button>
				</form>

			<?php endif; ?>

			<a href="/wp-content/uploads/contracts/contracts.csv" class="button button--dark / pull-left" download>Download CSV</a>
			<a href="/wp-content/uploads/contracts/contracts.json" class="button button--dark / pull-left" download>Download JSON</a>

		</div>

		<?php the_content(); ?>

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

						<tr>
							<td><?php echo $contract->phase ? $contract->phase : '-' ?></td>
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

<script src="<?php bloginfo('template_directory'); ?>/assets/js/libs/jquery.tablesorter.min.js"></script>

<script>

	$(document).ready(function() {

		$('.contracts-table').tablesorter({

			// set the initial table
			textExtraction: function(node) {

				var $node = $(node);

				if ( $node.filter('[data-value]').length ) {

					var value = $node.attr('data-value');

					if ( ! isNaN(parseFloat(value)) ) {
						value = parseFloat(value);
					}

					return value;

				} else {

					return $node.text().replace(/-/g, '');

				}

				return $node.innerHTML;

			}

		});

	});

</script>