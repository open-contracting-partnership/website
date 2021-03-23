<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use Timber\Timber;

class BackBarServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'ocp/back-bar',
				'title' => __('Back Bar'),
				'description' => __('Add a back bar to child pages.'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'format-image',
				'keywords' => ['back', 'bar'],
				'post_types' => ['page'],
				'supports' => [
					'align' => false,
				]
			]);

		});

	}

	public function render($block, $content = '', $is_preview = false, $post_id = 0) {

		$context = Timber::get_context();

		$context['block'] = [];

		// content
		$context['block']['link'] = get_field('link');

		if ($is_preview) {
			$context['block']['link']['url'] = '#';
			$context['block']['link']['target'] = '';
		}

		// colours
		$context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
		$context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
		$context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
		$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

		// options
		$context['block']['options'] = get_field('options') ?: [];

		echo Timber::compile('blocks/back-bar.twig', $context);

	}

}
