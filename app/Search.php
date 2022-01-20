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

    protected $language_code = 'en';

    public function __construct($query, $page = 1)
    {

        if (defined('ICL_LANGUAGE_CODE')) {
            $this->language_code = ICL_LANGUAGE_CODE;
        }

        // store the variables for later
        $this->query = urlencode($query);
        $this->page = $page;

        // fetch together the transient key identifier parts
        $transient_key_parts = [
            $this->query,
            $this->page
        ];

        // set the transient key
        $this->transient_key = sprintf(
            'ocp_google_cse_%s_%s',
            $this->language_code,
            hash('sha256', implode('||', $transient_key_parts))
        );

        // fetch the results
        $this->fetchResults();
    }

    public static function initHooks()
    {

        add_filter('query_vars', function ($query_vars) {
            $query_vars[] = 'page';
            return $query_vars;
        });
    }

    private function fetchResults()
    {

        if (false === ( $response = get_transient($this->transient_key) )) {
            // flas that the transient wasn't active
            $this->transient_active = false;

            $api_key = GOOGLE_CSE_EN_API_KEY;
            $site_id = GOOGLE_CSE_EN_ID;
            $language = 'lang_en';

            // set different settings for the spanish site
            if ($this->language_code === 'es') {
                $api_key = GOOGLE_CSE_ES_API_KEY;
                $site_id = GOOGLE_CSE_ES_ID;
                $language = 'lang_es';
            }

            // build the search query string
            $query_string = http_build_query([
                'key' => $api_key,
                'cx' => $site_id,
                'q' => $this->query,
                'lr' => $language,
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

        if (isset($response->items)) {
            $this->results = $response->items;
        }
    }

    public function isSearchCached()
    {
        return $this->transient_active;
    }

    public function hasResults()
    {
        return ! empty($this->results);
    }

    public function getResults()
    {
        return $this->results;
    }

    public function hasNextPage()
    {
        return $this->has_next_page;
    }
}
