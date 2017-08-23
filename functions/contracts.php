<?php

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

class Contracts {

	static function get_contracts() {

		global $wpdb;

		return $wpdb->get_results('SELECT * FROM ocp_contracts');

	}

	static function get_contract($contract_id) {

		if ( $contract_id === NULL ) {
			return false;
		}

		global $wpdb;

		$contract_id = htmlspecialchars($contract_id);

		$contract = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM ocp_contracts WHERE ocid = '%s'",
				$contract_id
			)
		);

		// return if there is a contract result
		return sizeof($contract) === 0 ? false : $contract;

	}

	private function date_filter($date) {

		// format the date given the incoming format
		$date = DateTime::createFromFormat('d/m/Y', $date);

		// weed out invalid times
		if ( ! $date ) {
			return;
		}

		// return the mysql date format
		return $date->format('Y-m-d');

	}

	public function fetch_contracts() {

		// fetch the primary contracts feed
		$contracts = @file_get_contents('http://contracts.open-contracting.org/raw/ocp/');
		$contracts = json_decode($contracts);

		// if the contracts response is empty, don't continue
		if ( ! $contracts ) {
			return;
		}

		global $wpdb;

		// just in case the table doesn't exist, re-create it
		$wpdb->query("CREATE TABLE IF NOT EXISTS `ocp_contracts` (
		  `ocid` varchar(255) NOT NULL DEFAULT '',
		  `supplier_name` varchar(255) DEFAULT NULL,
		  `contract_title` varchar(255) DEFAULT NULL,
		  `contract_status` varchar(255) DEFAULT NULL,
		  `contract_start_date` date DEFAULT NULL,
		  `contract_end_date` date DEFAULT NULL,
		  `contract_amount` float DEFAULT NULL,
		  `contract_currency` varchar(255) DEFAULT NULL,
		  `contract_phase` varchar(255) DEFAULT NULL,
		  `tender_status` varchar(255) DEFAULT NULL,
		  `tender_title` varchar(255) DEFAULT NULL,
		  `tender_start_date` date DEFAULT NULL,
		  `tender_end_date` date DEFAULT NULL,
		  PRIMARY KEY (`ocid`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

		// remove any previous contracts from the table
		$wpdb->query('TRUNCATE TABLE ocp_contracts');

		$phases = array(
			'planning',
			'tender',
			'award',
			'contract',
			'implementation'
		);

		// loop through the contracts
		foreach ( $contracts as $contract_meta ) {

			// fetch the contract information
			// we want to supress any errors too

			$contract = @file_get_contents($contract_meta->releaseUrl);
			$contract = json_decode($contract);

			// ignore falsey responses
			if ( ! $contract ) {
				continue;
			}

			$contract_phase = '';

			if ( $contract->releases[0]->tag ) {

				$tags = $contract->releases[0]->tag;

				foreach ( $phases as $phase ) {
					$contract_phase = in_array($phase, $tags) ? $phase : $contract_phase;
				}

			}

			if ( ! isset($contract->releases[0]->contracts) ) {
				continue;
			}

			// insert the contracts into the table
			$wpdb->insert('ocp_contracts', [
				'ocid' => $contract_meta->id,
				'supplier_name' => $contract->releases[0]->awards[0]->suppliers[0]->name,
				'contract_title' => $contract->releases[0]->contracts[0]->title,
				'contract_status' => $contract->releases[0]->contracts[0]->status,
				'contract_start_date' => $this->date_filter($contract->releases[0]->contracts[0]->period->startDate),
				'contract_end_date' => $this->date_filter($contract->releases[0]->contracts[0]->period->endDate),
				'contract_amount' => str_replace(',', '', $contract->releases[0]->contracts[0]->value->amount),
				'contract_currency' => $contract->releases[0]->contracts[0]->value->currency,
				'contract_phase' => $contract_phase,
				'tender_status' => $contract->releases[0]->tender->status,
				'tender_title' => $contract->releases[0]->tender->title,
				'tender_start_date' => $this->date_filter($contract->releases[0]->tender->tenderPeriod->startDate),
				'tender_end_date' => $this->date_filter($contract->releases[0]->tender->tenderPeriod->endDate)
			]);

		}

		// save updated contract files
		$this->save_contracts();

	}

	private function save_contracts() {

		global $wpdb;

		$contracts = $this->get_contracts();

		$this->save_to_json($contracts, './wp-content/themes/ocp-v1/public/contracts/contracts');
		$this->save_to_csv($contracts, './wp-content/themes/ocp-v1/public/contracts/contracts');

	}

	private function save_to_json($data, $file) {
		$content = json_encode($data);
		$file .= '.json';
		file_put_contents($file, $content);
	}

	// Code from http://imtheirwebguy.com/exporting-the-results-of-a-custom-wpdb-query-to-a-downloaded-csv/
	private function save_to_csv($data, $file) {

		$file .= '.csv';
		$fp = fopen($file, 'w');
		$first = true;

		// Parse results to csv format
		foreach ( $data as $row ) {

			// Add table headers
			if ( $first ) {

				$titles = array();

				foreach ( $row as $key => $val ) {
					$titles[] = $key;
				}

				fputcsv( $fp, $titles );

				$first = false;

			}

			$leadArray = (array) $row; // Cast the Object to an array

			// Add row to file
			fputcsv( $fp, $leadArray );

		}

		fclose($fp);

	}

}

if ( isset($_GET['reset_contracts']) ) {
	(new Contracts)->fetch_contracts();
}
