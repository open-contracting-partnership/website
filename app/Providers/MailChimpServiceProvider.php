<?php

namespace App\Providers;

use DrewM\MailChimp\MailChimp;
use Rareloop\Lumberjack\Facades\Config;
use Rareloop\Lumberjack\Providers\ServiceProvider;

class MailChimpServiceProvider extends ServiceProvider
{
    /**
     * Register any app specific items into the container
     */
    public function register()
    {
    }

    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {

        add_action('rest_api_init', function () {

            register_rest_route('ocp/v1', '/mailchimp/add-subscriber', array(
                'methods' => 'POST',
                'callback' => [$this, 'addSubscriber'],
                'permission_callback' => '__return_true'
            ));
        });
    }

    public static function addSubscriber($request)
    {
        if (! $request->get_param('email')) {
            return new \WP_Error('email_required', 'Email address is required', ['status' => 400]);
        }

        // fetch the mailchimp api from the options
        $mailchimp_api_key = Config::get('app.mailchimp_api_key');

        if (! $request->get_param('email')) {
            return new \WP_Error('mailchimp_api_key_not_set', 'MailChimp API key not set', ['status' => 500]);
        }

        // set the mailchimp connection
        $MailChimp = new MailChimp($mailchimp_api_key);

        // make a request to add the email to the list
        $result = $MailChimp->post('lists/fc9ec0e34b/members', [
            'email_address' => $request->get_param('email'),
            'tags' => $request->get_param('regions') ?? [],
            'status' => 'subscribed'
        ]);

        if ($result['status'] === 'subscribed') {
            return [
                'message' => __('Sucessfully subscribed!', 'ocp')
            ];
        } else {
            return new \WP_Error('mailchimp_error', $result['title'], ['status' => $result['status']]);
        }
    }
}
