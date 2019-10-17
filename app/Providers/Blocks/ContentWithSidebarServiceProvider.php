<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Timber;

class ContentWithSidebarServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'ocp/content-with-sidebar',
				'title' => __('Content with sidebar'),
				'description' => __('Add an image with a text overlay — great for headers.'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'format-image',
				'keywords' => ['content', 'sidebar']
			]);

		});

	}

	public function render() {

		$context = Timber::get_context();

		$context['block'] = [];
		$context['block']['content'] = get_field('content');
		// $context['block']['image'] = get_field('image');
		// $context['block']['overlay_color'] = get_field('overlay_colour') ?: '#000000';
		// $context['block']['background_opacity'] = get_field('background_opacity') / 100;
		$context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
		$context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
		$context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
		$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

		$context['block']['cta'] = [];

		if ( get_field('has_call_to_action') ) {
			$context['block']['cta']['colour_sheme'] = $context['block']['is_dark'] ? 'light' : 'dark';
			$context['block']['cta']['title'] = get_field('cta_title');
			$context['block']['cta']['link'] = get_field('cta_link');
		}

// dd($context);
		echo Timber::compile('blocks/content-with-sidebar.twig', $context);

	}

}
