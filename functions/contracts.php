<?php

use \App\Contracts;

// URL rewriting for contracts single
add_action('init', function() {

	add_rewrite_rule(
		'contracts/([^/]+)?$',
		'index.php?page_id=2568&contract_id=$matches[1]',
		'top'
	);

	add_rewrite_tag('%contract_id%','([^/]*)');

});

add_filter('query_vars', function($query_vars) {
	$query_vars[] = 'contract_id';
	return $query_vars;
});

function fetch_contracts() {

	// fire the contract fetch process
	(new Contracts)->fetch_contracts();

	// attempt to send a success message to the console
	if ( defined('WP_CLI') && \WP_CLI ) {
		\WP_CLI::success('Fetch contracts completed');
	}

}

if ( isset($_POST['reset_contracts']) && $_POST['reset_contracts'] === "true" ) {
	fetch_contracts();
}

if ( defined('WP_CLI') && \WP_CLI ) {
	\WP_CLI::add_command('ocp fetch-contracts', 'fetch_contracts');
}
