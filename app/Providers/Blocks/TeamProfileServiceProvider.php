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
				'enqueue_assets' => function() {

					wp_enqueue_script('block-team-profile', get_template_directory_uri() . '/dist/js/block-team-profile.js', ['manifest', 'vendor'], false, true);

					wp_localize_script('block-team-profile', '_options', [
						'is_admin' => is_admin()
					]);

				},
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
		$context['block']['team'] = get_field('team_members');

		$context['block']['team'] = array_map(function($person) {
			$person['slug'] = sanitize_title($person['name']);
			return $person;
		}, $context['block']['team']);
		
		echo Timber::compile('blocks/team-profile.twig', $context);

	}

}
