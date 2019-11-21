<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use Timber\Timber;

class DownloadCarouselServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'ocp/download-carousel',
				'title' => __('Download Carousel'),
				// 'description' => __('Add content.'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'download',
				'keywords' => ['download', 'carousel'],
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
		$context['block']['content'] = get_field('content');

		$context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
		$context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
		$context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
		$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

		$context['block']['width'] = get_field('width') ?: 'full';
		$context['block']['alignment'] = get_field('alignment') ?: 'left';
		$context['block']['size'] = get_field('size') ?: 'normal';

		echo Timber::compile('blocks/content.twig', $context);

	}

}
