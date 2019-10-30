<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use Timber\Timber;

class SignUpCoverServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'ocp/sign-up-cover',
				'title' => __('Sign Up Cover'),
				'description' => __('Add a sign-up form with an image.'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'format-image',
				'enqueue_assets' => function() {

					wp_enqueue_script('mailchimp', get_template_directory_uri() . '/dist/js/mailchimp.js', array(), false, true);

					wp_localize_script('mailchimp', 'mailchimp_options', [
					    'root' => esc_url_raw(rest_url()),
						'error_text' => __('An error occured, try again later.', 'ocp')
					]);

				},
				'keywords' => ['cover', 'sign', 'up', 'sign-up'],
				'supports' => [
					'align' => false
				]
			]);

		});

	}

	public function render() {

		$context = Timber::get_context();

		$context['block'] = [];
		$context['block']['heading'] = get_field('heading') ?: 'Add primary title here&hellip;';
		$context['block']['image'] = get_field('image');
		$context['block']['overlay_color'] = get_field('overlay_colour') ?: '#000000';
		$context['block']['background_opacity'] = get_field('background_opacity') / 100;
		$context['block']['background_color'] = hex2rgba($context['block']['overlay_color'], $context['block']['background_opacity']);

		echo Timber::compile('blocks/sign-up-cover.twig', $context);

	}

}
