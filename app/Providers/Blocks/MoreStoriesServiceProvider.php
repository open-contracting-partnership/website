<?php

namespace App\Providers\Blocks;

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
        add_action('acf/init', function () {
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

    public function render()
    {
        $context = Timber::get_context();

        $context['block'] = [];
        $context['block']['title'] = get_field('title');
        $context['block']['subheading'] = get_field('subheading');
        $context['block']['call_to_action'] = get_field('call_to_action');
        $context['block']['card_type'] = get_field('card_type') ?: 'default';
        $context['block']['has_featured'] = get_field('has_featured');
        $context['block']['card_options'] = [];

        if ($context['block']['card_type'] === 'resource') {
            $context['block']['card_options']['colour_scheme'] = get_field('colour_scheme');
        }

        $context['block']['stories'] = [];

        $manualStories = get_field('manually_enter_content') ?: false;

        if (! $manualStories) {
            if ($stories = get_field('stories')) {
                if ($context['block']['card_type'] === 'default') {
                    $context['block']['stories'] = PrimaryCard::convertCollection(
                        $stories,
                        function ($new, $original, $index) use ($context) {
                            $new['is_featured'] = $index === 0 && $context['block']['has_featured'] === true;

                            if ($new['is_featured']) {
                                $new['type_key'] = 'featured';
                                $new['type_label'] = 'Featured';
                            }

                            return $new;
                        }
                    );
                }

                if ($context['block']['card_type'] === 'resource') {
                    $context['block']['stories'] = ResourceCard::convertCollection($stories);
                }
            }
        } else {
            $context['block']['stories'] = collect(get_field('manual_stories'))
                ->map(function ($story) {
                    return [
                        'title' => $story['heading'],
                        'introduction' => $story['strapline'],
                        'url' => $story['link'],
                        'image_url' => $story['image']['url'],
                        'button_label' => 'FIND OUT MORE'
                    ];
                })
                ->toArray();
        }

        $context['block']['background_colour'] = get_field('background_colour') ?: '#DADADA';
        $context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];
        $context['block']['header_alignment'] = get_field('header_alignment') ?: 'justified';

        // options
        $context['block']['options'] = get_field('options') ?: [];

        echo Timber::compile('blocks/more-stories.twig', $context);
    }
}
