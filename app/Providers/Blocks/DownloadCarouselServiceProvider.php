<?php

namespace App\Providers\Blocks;

use App\Providers\Blocks\BaseBlock;
use Timber\Timber;

class DownloadCarouselServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/download-carousel',
                'title' => __('Download Carousel'),
                // 'description' => __('Add content.'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'download',
                'enqueue_assets' => function () {
                    wp_enqueue_script('block-download-carousel', get_template_directory_uri() . '/dist/js/block-download-carousel.js', ['manifest'], false, true);
                },
                'keywords' => ['download', 'carousel'],
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
        $context['block']['downloads'] = get_field('downloads') ?: [];

        // options
        $context['block']['options'] = get_field('options') ?: [];

        echo Timber::compile('blocks/download-carousel.twig', $context);
    }
}
