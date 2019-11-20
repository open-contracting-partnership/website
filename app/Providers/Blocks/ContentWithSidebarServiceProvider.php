<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
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
				'keywords' => ['content', 'sidebar'],
				'post_types' => ['page'],
				'supports' => [
					'align' => false
				]
			]);

		});

	}

	public function render($block) {

		$context = Timber::get_context();

		$context['block'] = [];
		$context['block']['title'] = get_field('title');
		$context['block']['primary_content'] = get_field('primary_content');
		$context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
		$context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
		$context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
		$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];
		$context['block']['sidebar_content'] = get_field('sidebar_content');
		$context['block']['sidebar_width'] = get_field('sidebar_width');
		$context['block']['options'] = get_field('options') ?: [];
		$context['block']['options']['sidebar_alignment'] = get_field('sidebar_alignment');

		if ( isset($block['className']) ) {
			$context['block']['options']['classes'] = $block['className'];
		}

		echo Timber::compile('blocks/content-with-sidebar.twig', $context);

	}

}
