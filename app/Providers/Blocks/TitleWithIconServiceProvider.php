<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use Timber\Timber;

class TitleWithIconServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'ocp/title-with-icon',
				'title' => __('Title with Icon'),
				// 'description' => __('Add content.'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'format-image',
				'keywords' => ['title', 'icon'],
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

		// content
		$context['block']['primary_content'] = get_field('primary_content');
		$context['block']['sidebar_content'] = get_field('sidebar_content');

		// colours
		$context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
		$context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
		$context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
		$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

		// options
		$context['block']['options'] = get_field('options') ?: [];
		$context['block']['options']['sidebar_vertical_alignment'] = get_field('sidebar_vertical_alignment');
		$context['block']['options']['content_text_align'] = get_field('content_text_align');
		$context['block']['options']['primary_column_width'] = get_field('primary_column_width');
		$context['block']['options']['size'] = get_field('size');
		$context['block']['options']['show_sidebar'] = get_field('show_sidebar');

		if ( get_field('show_sidebar') && $context['block']['options']['primary_column_width'] === 'full' ) {
			$context['block']['options']['primary_column_width'] = 'large';
		}

		if ( isset($block['className']) ) {
			$context['block']['options']['classes'] = $block['className'];
		}

		echo Timber::compile('blocks/content.twig', $context);

	}

}
