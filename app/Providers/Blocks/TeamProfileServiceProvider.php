<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use Timber\Timber;

class TeamProfileServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'ocp/team-profile',
				'title' => __('Team Profile'),
				'description' => __('Display a list of team members.'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'format-image',
				'keywords' => ['team', 'profile'],
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
		$context['block']['heading'] = get_field('heading') ?: 'Add primary title here&hellip;';
		$context['block']['image'] = get_field('image');
		$context['block']['overlay_color'] = get_field('overlay_colour') ?: '#000000';
		$context['block']['background_opacity'] = get_field('background_opacity') / 100;
		$context['block']['background_color'] = hex2rgba($context['block']['overlay_color'], $context['block']['background_opacity']);

		echo Timber::compile('blocks/team-profile.twig', $context);

	}

}
