<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Timber;

class StoriesServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'stories',
				'title' => __('Stories'),
				'description' => __('A block to display stories'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'welcome-widgets-menus',
				'keywords' => ['story', 'stories']
			]);

		});

	}

	public function render() {

		$context = Timber::get_context();

		$context['block'] = [];

		$context['block']['primary_title'] = get_field('primary_title') ?: 'Primary title here...';
		$context['block']['primary_links'] = array_column(get_field('primary_links') ?: [], 'link');
		$context['block']['primary_content'] = get_field('primary_content');
		$context['block']['primary_stories'] = get_field('primary_stories');

		$context['block']['secondary_title'] = get_field('secondary_title') ?: 'Secondary title here...';
		$context['block']['secondary_links'] = array_column(get_field('secondary_links') ?: [], 'link');
		$context['block']['secondary_content'] = get_field('secondary_content');
		$context['block']['secondary_stories'] = get_field('secondary_stories');

		$context['block']['background_colour'] = get_field('background_colour') ?: '#6C75E1';
		$context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
		$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

		echo Timber::compile('blocks/stories.twig', $context);

	}

}
