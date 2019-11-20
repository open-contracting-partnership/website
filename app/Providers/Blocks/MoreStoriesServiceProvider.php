<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use App\Cards\PrimaryCard;
use App\Cards\ResourceCard;
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
		$context['block']['title'] = get_field('title');
		$context['block']['card_type'] = get_field('card_type') ?: 'default';
		$context['block']['card_options'] = [];

		if ( $context['block']['card_type'] === 'resource' ) {
			$context['block']['card_options']['colour_scheme'] = get_field('colour_scheme');
		}

		$context['block']['stories'] = [];

		if ( $stories = get_field('stories') ) {

			foreach ( $stories as $story ) {

				if ( $context['block']['card_type'] === 'default' ) {

					if ( $story['acf_fc_layout'] === 'internal_link' ) {
						$context['block']['stories'][] = PrimaryCard::buildData($story['link'][0]);
					}

					if ( $story['acf_fc_layout'] === 'custom_link' ) {

						$context['block']['stories'][] = [
							'image_url' => $story['image']['url'],
							'type_label' => $story['type'],
							'title' => $story['title'],
							'url' => $story['url'],
							'meta' => $story['meta'],
							'button_label' => $story['button_label'] ?: __('Read', 'ocp')
						];

					}

				}

				if ( $context['block']['card_type'] === 'resource' ) {

					if ( $story['acf_fc_layout'] === 'internal_link' ) {
						$context['block']['stories'][] = ResourceCard::buildPostById($story['link'][0]);
					}

					if ( $story['acf_fc_layout'] === 'custom_link' ) {

						$context['block']['stories'][] = [
							'title' => $story['title'],
							'type_label' => $story['type'],
							'url' => $story['url']
						];

					}

				}

			}

		}

		$context['block']['background_colour'] = get_field('background_colour') ?: '#DADADA';
		$context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
		$context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

		echo Timber::compile('blocks/more-stories.twig', $context);

	}

}
