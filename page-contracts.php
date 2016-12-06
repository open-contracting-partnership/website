<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="page__container">

		<div class="wrapper / page__wrapper / page--padding">

			<?php get_partial('page', 'title'); ?>

			<section>

				<?php the_content(); ?>

				<?php

					global $wpdb;

					$contracts = $wpdb->get_results('SELECT * FROM ocp_contracts');

				?>

				<?php if ( $contracts ) : ?>

					<table class="contracts-table">

						<thead>

							<tr>
								<th>Supplier</th>
								<th>Title</th>
								<th>Status</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Amount</th>
								<th>Currency</th>
							</tr>

						</thead>

						<tbody>

							<?php foreach ( $contracts as $contract ) : ?>

								<tr>
									<td><?php echo $contract->supplier_name; ?></td>
									<td><?php echo $contract->contract_title; ?></td>
									<td><?php echo ucwords($contract->contract_status); ?></td>
									<td><?php echo $contract->contract_start_date; ?></td>
									<td><?php echo $contract->contract_end_date; ?></td>
									<td><?php echo number_format($contract->contract_amount * rand()); ?></td>
									<td><?php echo $contract->contract_currency; ?></td>
								</tr>

							<?php endforeach; ?>

						</tbody>

					</table>

				<?php endif; ?>

			</section>

		</div> <!-- / .wrapper -->

	</div> <!-- / .page__container -->

	<script src="<?php bloginfo('template_directory'); ?>/assets/js/libs/jquery.tablesorter.min.js"></script>

	<script>

		$(document).ready(function() {
		    $('.contracts-table').tablesorter();
		});

	</script>

<?php get_footer(); ?>
