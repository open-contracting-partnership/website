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
        $context['block']['quotes'] = collect(get_field('quotes') ?: [])
            ->map(function ($quote) {
                $quote['footer'] = [];

                if ($quote['name']) {
                    $quote['footer']['name'] = $quote['name'];
                }

                if ($quote['bio']) {
                    $quote['footer']['bio'] = $quote['bio'];
                }

                return $quote;
            });

        $context['block']['background_colour'] = get_field('background_colour') ?: '#23B2A7';
        $context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];
        $context['block']['header_alignment'] = get_field('header_alignment') ?: 'justified';
        $context['block']['image_style'] = get_field('image_style') ?: 'grayscale';

        // options
        $context['block']['options'] = get_field('options') ?: [];

        echo Timber::compile('blocks/quote-carousel.twig', $context);
    }
}
