<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use Timber\Timber;

class CardServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'ocp/card',
				'title' => __('Card'),
				// 'description' => __('Grid section includes a heading, strapline and a grid of contents.'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'grid-view',
				'keywords' => ['card'],
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
		$context['block']['lead'] = get_field('lead');
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

		echo Timber::compile('blocks/card.twig', $context);

	}

}
