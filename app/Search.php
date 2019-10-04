<?php

namespace App;

class Search
{

	private $query;
	private $page;
	private $results = [];
	private $has_next_page = false;

	// transient variables
	private $transient_active = true;
	protected $transient_key;

	public function __construct($query, $page = 1) {

		// store the variables for later
		$this->query = urlencode($query);
		$this->page = $page;

		// fetch together the transient key identifier parts
		$transient_key_parts = [
			$this->query,
			$this->page
		];

		// set the transient key
		$this->transient_key = 'ocp_google_cse_' . hash('sha256', implode('||', $transient_key_parts));

		// fetch the results
		$this->fetchResults();

	}

	public static function initHooks() {

		add_filter('query_vars', function($query_vars) {
			$query_vars[] = 'page';
			return $query_vars;
		});

	}

	private function fetchResults() {

		if ( false === ( $response = get_transient($this->transient_key) ) ) {

			// flas that the transient wasn't active
			$this->transient_active = false;

			// build the search query string
			$query_string = http_build_query([
				'key' => GOOGLE_CSE_API_KEY,
				'cx' => GOOGLE_CSE_ID,
				'q' => $this->query,
				'lr' => 'lang_en',
				'start' => (10 * ($this->page - 1)) + 1
			]);

			// fire off the request
			$ch = curl_init('https://www.googleapis.com/customsearch/v1?' . $query_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$data = curl_exec($ch);
			curl_close($ch);

			$response = json_decode($data);

			// set the transient for next time
		    set_transient($this->transient_key, $response, 30 * MINUTE_IN_SECONDS);

		}

		$this->has_next_page = isset($response->queries->nextPage);

		if ( isset($response->items) ) {
			$this->results = $response->items;
		}

	}

	public function isSearchCached() {
		return $this->transient_active;
	}

	public function hasResults() {
		return ! empty($this->results);
	}

	public function getResults() {
		return $this->results;
	}

	public function hasNextPage() {
		return $this->has_next_page;
	}

}
