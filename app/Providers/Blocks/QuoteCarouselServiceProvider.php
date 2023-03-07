<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class QuoteCarouselServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/quote-carousel',
                'title' => __('Quote Carousel'),
                // 'description' => __('Add content.'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'format-quote',
                'enqueue_assets' => function () {
                    wp_enqueue_script('block-quote-carousel', get_template_directory_uri() . '/dist/js/block-quote-carousel.js', ['manifest'], false, true);
                    wp_enqueue_script('card-quote', get_template_directory_uri() . '/dist/js/card-quote.js', ['manifest'], false, true);
                },
                'keywords' => ['quote', 'carousel'],
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
        $context['block']['quotes'] = get_field('quotes') ?: [];

        $context['block']['background_colour'] = get_field('background_colour') ?: '#23B2A7';
        $context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        // options
        $context['block']['options'] = get_field('options') ?: [];

        echo Timber::compile('blocks/quote-carousel.twig', $context);
    }
}
