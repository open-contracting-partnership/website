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

	public static $phases = [
		'planning' => 'Planning',
		'tender' => 'Tender',
		'award' => 'Award',
		'contract' => 'Contract',
		'implementation' => 'Implementation'
	];

	static function get_contracts() {

		global $wpdb;

		return $wpdb->get_results("SELECT * FROM {$wpdb->prefix}contracts");

	}

	static function get_contract($contract_id) {

		if ( $contract_id === NULL ) {
			return false;
		}

		global $wpdb;

		$contract_id = htmlspecialchars($contract_id);

		$contract = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$wpdb->prefix}contracts WHERE ocid = '%s'",
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

	public static function phase_number($phase) {
		return array_search($phase, array_keys(self::$phases)) + 1;
	}

	public function fetch_contracts() {

		// ATTN: temp disable the fetching of contracts while
		// ocp are creating their new contracts back end
		return;

		// fetch the primary contracts feed
		$contracts = @file_get_contents('http://contracts.open-contracting.org/raw/ocp/');
		$contracts = json_decode($contracts);

		// if the contracts response is empty, don't continue
		if ( ! $contracts ) {
			return;
		}

		global $wpdb;

		// just in case the table doesn't exist, re-create it
		$wpdb->query("DROP TABLE `{$wpdb->prefix}contracts`;");
		$wpdb->query("CREATE TABLE `{$wpdb->prefix}contracts` (

			`ocid` varchar(255) NOT NULL DEFAULT '',
			`supplier_name` varchar(255) DEFAULT NULL,
			`phase` varchar(255) DEFAULT NULL,

			`planning_amount` float DEFAULT NULL,
			`planning_currency` varchar(255) DEFAULT NULL,
			`planning_rationale` varchar(255) DEFAULT NULL,

			`tender_title` varchar(255) DEFAULT NULL,
			`tender_description` text DEFAULT NULL,
			`tender_status` varchar(255) DEFAULT NULL,
			`tender_procurement` varchar(255) DEFAULT NULL,
			`tender_rationale` text DEFAULT NULL,
			`tender_criteria` varchar(255) DEFAULT NULL,
			`tender_start_date` date DEFAULT NULL,
			`tender_end_date` date DEFAULT NULL,
			`tender_enquiries` varchar(255) DEFAULT NULL,
			`tender_tor` varchar(255) DEFAULT NULL,

			`award_date` date DEFAULT NULL,
			`award_value` float DEFAULT NULL,
			`award_currency` varchar(255) DEFAULT NULL,
			`award_supplier` varchar(255) DEFAULT NULL,

			`contract_title` varchar(255) DEFAULT NULL,
			`contract_status` varchar(255) DEFAULT NULL,
			`contract_start_date` date DEFAULT NULL,
			`contract_end_date` date DEFAULT NULL,
			`contract_amount` float DEFAULT NULL,
			`contract_currency` varchar(255) DEFAULT NULL,
			`contract_signed` date DEFAULT NULL,
			`contract_document` varchar(255) DEFAULT NULL,
			`contract_document_title` varchar(255) DEFAULT NULL,

			`implementation_milestones` text DEFAULT NULL,

			PRIMARY KEY (`ocid`)

		) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

		// remove any previous contracts from the table
		$wpdb->query("TRUNCATE TABLE {$wpdb->prefix}contracts");

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

			$phase = '';

			// attempt to determine the contract phase
			if ( $contract->releases ) {
				$phase = property_exists($contract->releases[0], 'planning') ? 'planning' : $phase;
				$phase = property_exists($contract->releases[0], 'tender') ? 'tender' : $phase;
				$phase = property_exists($contract->releases[0], 'awards') ? 'award' : $phase;
				$phase = property_exists($contract->releases[0], 'contracts') ? 'contract' : $phase;
				$phase = property_exists($contract->releases[0], 'implementation') ? 'implementation' : $phase;
			}

			$implementation_milestones = array();

			foreach ( $contract->releases[0]->contracts[0]->implementation->milestones as $milestones ) {

				if ( $milestone->title && $milestone->status ) {

					$implementation_milestones = array(
						'title' => $milestone->title,
						'status' => $milestone->status
					);

				}

			}

			// insert the contracts into the table
			$wpdb->insert("{$wpdb->prefix}contracts", [

				'ocid' => $contract_meta->id,
				'supplier_name' => $contract->releases[0]->awards[0]->suppliers[0]->name,
				'phase' => $phase,

				'planning_amount' => str_replace(',', '', $contract->releases[0]->planning->budget->amount->amount),
				'planning_currency' => $contract->releases[0]->planning->budget->amount->currency,
				'planning_rationale' => $contract->releases[0]->planning->rationale,

				'tender_status' => $contract->releases[0]->tender->status,
				'tender_title' => $contract->releases[0]->tender->title,
				'tender_procurement' => $contract->releases[0]->tender->procurementMethod,
				'tender_rationale' => $contract->releases[0]->tender->procurementMethodRationale,
				'tender_description' => $contract->releases[0]->tender->description,
				'tender_criteria' => $contract->releases[0]->tender->eligibilityCriteria,
				'tender_start_date' => $this->date_filter($contract->releases[0]->tender->tenderPeriod->startDate),
				'tender_end_date' => $this->date_filter($contract->releases[0]->tender->tenderPeriod->endDate),
				'tender_enquiries' => $contract->releases[0]->tender->hasEnquiries,
				'tender_tor' => $contract->releases[0]->tender->documents[0]->url,

				'award_date' => $this->date_filter($contract->releases[0]->awards->date),
				'award_value' => str_replace(',', '', $contract->releases[0]->awards->value->amount),
				'award_currency' => $contract->releases[0]->awards->value->currency,
				'award_supplier' => $contract->releases[0]->awards[0]->suppliers[0]->name,

				'contract_title' => $contract->releases[0]->contracts[0]->title,
				'contract_status' => $contract->releases[0]->contracts[0]->status,
				'contract_start_date' => $this->date_filter($contract->releases[0]->contracts[0]->period->startDate),
				'contract_end_date' => $this->date_filter($contract->releases[0]->contracts[0]->period->endDate),
				'contract_amount' => str_replace(',', '', $contract->releases[0]->contracts[0]->value->amount),
				'contract_currency' => $contract->releases[0]->contracts[0]->value->currency,
				'contract_signed' => $this->date_filter($contract->releases[0]->contracts[0]->dateSigned),
				'contract_document' => $contract->releases[0]->contracts[0]->documents[0]->url,
				'contract_document_title' => $contract->releases[0]->contracts[0]->documents[0]->title,

				'implementation_milestones' => serialize($implementation_milestones),

			]);

		}

		// save updated contract files
		$this->save_contracts();

	}

	private function save_contracts() {

		global $wpdb;

		$contracts = $this->get_contracts();

		$this->save_to_json($contracts, './wp-content/uploads/contracts/');
		$this->save_to_csv($contracts, './wp-content/uploads/contracts/');

	}

	private function save_to_json($data, $file) {
		$content = json_encode($data);
		file_put_contents('./wp-content/uploads/contracts/contracts.json', $content);
	}

	// Code from http://imtheirwebguy.com/exporting-the-results-of-a-custom-wpdb-query-to-a-downloaded-csv/
	private function save_to_csv($data, $file) {

		$fp = fopen('./wp-content/uploads/contracts/contracts.csv', 'w');
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

if ( $_POST['reset_contracts'] === "true" ) {
	(new Contracts)->fetch_contracts();
}
