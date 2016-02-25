<?php // functions/mailchimp.php

use \DrewM\MailChimp\MailChimp;

function add_subscriber($email) {

	// fetch the mailchimp api from the options
	$mailchimp_api_key = get_field('mailchimp_api_key', 'options');

	// only proceed if the api is not empty
	if ( $mailchimp_api_key ) {

		// set the mailchimp connection
		$MailChimp = new MailChimp($mailchimp_api_key);

		// make a request to add the email to the list
		$result = $MailChimp->post('lists/fc9ec0e34b/members/', [
			'email_address' => $email,
			'status' => 'subscribed'
		]);
		
		return isset($result['id']);

	}

}
