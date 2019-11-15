<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class LogosServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'ocp/logos',
				'title' => __('Logos'),
				'description' => __('Display a range of logos'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'screenoptions',
				'keywords' => ['logo', 'logos'],
				'post_types' => ['page'],
				'supports' => [
					'align' => false
				]
			]);

		});

	}

	public function render() {

		$context = Timber::get_context();

		$context['block'] = [];
		$context['block']['title'] = get_field('title');
		$context['block']['logos'] = get_field('logos');

		$context['block']['background_colour'] = get_field('background_colour') ?: '#6C75E1';
		$context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
		$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

		echo Timber::compile('blocks/logos.twig', $context);

	}

}
