<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Timber;

class MoreStoriesServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'ocp/more-stories',
				'title' => __('More Stories'),
				'description' => __('Display more stories'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'welcome-widgets-menus',
				'keywords' => ['story', 'stories', 'more']
			]);

		});

	}

	public function render() {

		$context = Timber::get_context();

		$context['block'] = [];

		$context['block']['title'] = get_field('title') ?: 'Title here...';
		$context['block']['stories'] = get_field('stories');

		$context['block']['background_colour'] = get_field('background_colour') ?: '#6C75E1';
		$context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
		$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

		echo Timber::compile('blocks/more-stories.twig', $context);

	}

}
