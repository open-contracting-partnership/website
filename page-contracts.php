<?php

	if ( isset($_GET['reset_contracts']) ) {
		header('Location: /contracts/');
	}

	$contract_id = get_query_var('contract_id', NULL);
	$contract = NULL;

	if ( $contract_id !== NULL ) {
		$contract = Contracts::get_contract($contract_id);
	}

	if ( $contract === false ) {

		status_header(404);
        nocache_headers();

        include(get_query_template('404'));

        die();

	}

?>

<?php get_header(); ?>

	<?php

		get_partial(
			'contracts',
			$contract === NULL ? 'overview' : 'single',
			array('contract' => $contract)
		);

	?>

<?php get_footer(); ?>
