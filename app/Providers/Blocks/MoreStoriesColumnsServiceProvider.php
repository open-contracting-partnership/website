<?php

namespace App\Providers\Blocks;

use App\Cards\ResourceCard;
use App\Cards\TextCard;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class MoreStoriesColumnsServiceProvider
{

	/**
	 * Perform any additional boot required for this application
	 */
	public function boot()
	{

		add_action('acf/init', function() {

			acf_register_block_type([
				'name' => 'ocp/more-stories-columns',
				'title' => __('More Stories (Columns)'),
				'description' => __('Display more stories'),
				'render_callback' => array($this, 'render'),
				'category' => 'ocp-blocks',
				'icon' => 'welcome-widgets-menus',
				'keywords' => ['story', 'stories', 'more'],
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
		$context['block']['columns'] = get_field('columns');

		foreach ( $context['block']['columns'] as &$column ) {

			if ( $column['automatic_posts'] ) {

				if ( $column['acf_fc_layout'] === 'resource' ) {

					$posts = Timber::get_posts([
						'post_type' => $column['automatic_post_type'],
						'posts_per_page' => 2
					]);

					$column['posts'] = ResourceCard::convertTimberCollection($posts);

				}

				if ( $column['acf_fc_layout'] === 'default' ) {

					$posts = Timber::get_posts([
						'post_type' => $column['automatic_post_type'],
						'posts_per_page' => 3
					]);

					$column['posts'] = TextCard::convertTimberCollection($posts);

				}

			} else {


			}

		}


		// dd($context['block']['columns']);

		//
		// if ( $stories = get_field('stories') ) {
		//
		// 	foreach ( $stories as $story ) {
		//
		// 		if ( $story['acf_fc_layout'] === 'internal_link' ) {
		// 			$context['block']['stories'][] = PrimaryCard::buildData($story['link'][0]);
		// 		}
		//
		// 		if ( $story['acf_fc_layout'] === 'custom_link' ) {
		//
		// 			$context['block']['stories'][] = [
		// 				'image_url' => $story['image']['url'],
		// 				'type_label' => $story['type'],
		// 				'title' => $story['title'],
		// 				'url' => $story['url'],
		// 				'meta' => $story['meta'],
		// 				'button_label' => $story['button_label'] ?: __('Read', 'ocp')
		// 			];
		//
		// 		}
		//
		// 	}
		//
		// }

		$context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
		$context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
		$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

		echo Timber::compile('blocks/more-stories-columns.twig', $context);

	}

}
