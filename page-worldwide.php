<?php // page.php ?>

<?php get_header(); ?>

	<?php

		the_post();

		wp_localize_script('page-worldwide', 'content', [
			'title' => get_the_title(),
			'content' => str_replace(["\n", "\r"], '', apply_filters('the_content', get_the_content())),
			'table_view' => __('Table view', 'ocp'),
			'map_view' => __('Map view', 'ocp'),
			'map' => array(
				'filter' => __('Filter Options', 'ocp'),
				'close' => __('Close', 'ocp'),
			),
			'filter' => array(
				'all' => __('Active countries', 'ocp'),
				'ocds' => __('Using the Open Contracting Data Standard', 'ocp'),
				'ocds_status' => __('Status:', 'ocp'),
				'ocds_ongoing' => __('Ongoing', 'ocp'),
				'ocds_implementation' => __('Implementation', 'ocp'),
				'ocds_historic' => __('Historic', 'ocp'),
				'commitments' => __('With documented commitments', 'ocp'),
				'contract' => __('With innovation in contracting monitoring & data use', 'ocp'),
			),
			'country' => array(
				'ocds' => __('Using the Open Contracting Data Standard', 'ocp'),
				'commitments' => __('Documented commitments', 'ocp'),
				'contract' => __('Innovation in contract monitoring & data use', 'ocp'),
				'impact_stories' => __('Impact Stories', 'ocp'),
				'no_data' => __('No data available', 'ocp'),
				'improve_data' => __('Improve this data', 'ocp'),
			),
			'search' => array(
				'placeholder' => __('Find Country', 'ocp'),
				'no_data' => __('(No data yet)', 'ocp')
			)
		]);

	?>

	<div id="worldwide">
		<router-view></router-view>
	</div>

<?php get_footer(); ?>
