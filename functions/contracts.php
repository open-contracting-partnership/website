<?php

if ( ! wp_next_scheduled('fetch_contracts_hook') ) {
	wp_schedule_event(time(), 'daily', 'fetch_contracts_hook');
}

add_action('fetch_contracts_hook', 'fetch_contracts');

function date_filter($date) {

	// format the date given the incoming format
	$date = DateTime::createFromFormat('d/m/Y', $date);

	// weed out invalid times
	if ( ! $date ) {
		return;
	}

	// return the mysql date format
	return $date->format('Y-m-d');

}

function fetch_contracts() {

	global $wpdb;

	// just in case the table doesn't exist, re-create it
	$wpdb->query("CREATE TABLE IF NOT EXISTS `ocp_contracts` (
	  `ocid` varchar(255) NOT NULL DEFAULT '',
	  `supplier_name` varchar(255) NOT NULL DEFAULT '',
	  `contract_title` varchar(255) DEFAULT NULL,
	  `contract_status` varchar(255) DEFAULT NULL,
	  `contract_start_date` date DEFAULT NULL,
	  `contract_end_date` date DEFAULT NULL,
	  `contract_amount` float DEFAULT NULL,
	  `contract_currency` varchar(255) DEFAULT NULL,
	  `tender_status` varchar(255) DEFAULT NULL,
	  `tender_title` varchar(255) DEFAULT NULL,
	  `tender_start_date` date DEFAULT NULL,
	  `tender_end_date` date DEFAULT NULL,
	  PRIMARY KEY (`ocid`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

	// remove any previous contracts from the table
	$wpdb->query('TRUNCATE TABLE ocp_contracts');

	// temp, to be replaced by a feed of contracts
	$contract_ids = array(
		'ocds-azam7x-4tli5hdc-ocp',
		'ocds-azam7x-4tli5hdc-ocp',
		'ocds-azam7x-4tli5hdc-ocp',
		'ocds-azam7x-4tli5hdc-ocp',
		'ocds-azam7x-4tli5hdc-ocp'
	);

	// loop through the contracts
	foreach ( $contract_ids as $contract_id ) {

		// fetch the contract information
		// we want to supress any errors too

		$contract = @file_get_contents('http://contracts.open-contracting.org/raw/ocp/' . $contract_id . '/');
		$contract = json_decode($contract);

		// ignore falsey responses
		if ( ! $contract ) {
			continue;
		}

		// insert the contracts into the table
		$wpdb->insert('ocp_contracts', [
			'ocid' => $contract_id . rand(000, 999),
			'supplier_name' => $contract->releases[0]->awards[0]->suppliers[0]->name,
			'contract_title' => $contract->releases[0]->contracts[0]->title,
			'contract_status' => $contract->releases[0]->contracts[0]->status,
			'contract_start_date' => date_filter($contract->releases[0]->contracts[0]->period->startDate),
			'contract_end_date' => date_filter($contract->releases[0]->contracts[0]->period->endDate),
			'contract_amount' => $contract->releases[0]->contracts[0]->value->amount,
			'contract_currency' => $contract->releases[0]->contracts[0]->value->currency,
			'tender_status' => $contract->releases[0]->tender->status,
			'tender_title' => $contract->releases[0]->tender->title,
			'tender_start_date' => date_filter($contract->releases[0]->tender->tenderPeriod->startDate),
			'tender_end_date' => date_filter($contract->releases[0]->tender->tenderPeriod->endDate)
		]);

	}

}
