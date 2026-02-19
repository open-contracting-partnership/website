<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class OurModelServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/our-model',
                'title' => __('Our Model'),
                'description' => __('Add the model diagram.'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'update',
                'enqueue_assets' => function () {
                    wp_enqueue_script('block-our-model');
                },
                'keywords' => ['content', 'sidebar'],
                'post_types' => ['page'],
                'supports' => [
                    'align' => false
                ]
            ]);
        });
    }

    public function render(): void
    {
        $context = Timber::get_context();

        $context['block'] = [];
        $context['block']['title'] = get_field('title');
        $context['block']['content'] = get_field('content');

        $context['block']['content_publish'] = get_field('content_publish');
        $context['block']['content_engagement'] = get_field('content_engagement');
        $context['block']['content_measure'] = get_field('content_measure');
        $context['block']['content_goals'] = get_field('content_goals');

        $context['block']['im_convinced_link'] = get_field('im_convinced_link');
        $context['block']['im_not_convinced_link'] = get_field('im_not_convinced_link');

        $context['block']['i18n'] = [
            'im_convinced_heading' => _x("I'm convinced.", 'Our model block', 'ocp'),
            'im_not_convinced_heading' => _x("I'm not convinced yet.", 'Our model block', 'ocp')
        ];

        $context['block']['model_svg'] = file_get_contents(__DIR__ . '/../../../resources/img/our-model.svg');

        $context['block']['language_override'] = get_field('language_override');

        $context['block']['background_colour'] = get_field('background_colour') ?: '#6C75E1';
        $context['block']['is_dark'] = isContrastingColourLight($context['block']['background_colour']);
        $context['block']['text_colour'] = $context['block']['is_dark'] ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        // options
        $context['block']['options'] = get_field('options') ?: [];

        Timber::render('blocks/our-model.twig', $context);
    }
}
