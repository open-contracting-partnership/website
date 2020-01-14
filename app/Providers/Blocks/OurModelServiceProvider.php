<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use Timber\Timber;

class OurModelServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'ocp/our-model',
				'title' => __('Our Model'),
				'description' => __('Add the model diagram.'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'update',
				'enqueue_assets' => function() {
					wp_enqueue_script('block-our-model', get_template_directory_uri() . '/dist/js/block-our-model.js', ['manifest'], false, true);
				},
				'keywords' => ['content', 'sidebar'],
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

		$context['block']['content_publish'] = get_field('content_publish');
		$context['block']['content_engagement'] = get_field('content_engagement');
		$context['block']['content_measure'] = get_field('content_measure');
		$context['block']['content_goals'] = get_field('content_goals');

		$context['block']['model_svg'] = file_get_contents(__DIR__ . '/../../../resources/img/our-model.svg');

		$context['block']['background_colour'] = get_field('background_colour') ?: '#6C75E1';
		$context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
		$context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
		$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

		echo Timber::compile('blocks/our-model.twig', $context);

	}

}
