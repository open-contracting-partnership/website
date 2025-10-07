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
    public function boot(): void
    {
        add_action('acf/init', function () {
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

    public function render(): void
    {
        $context = Timber::get_context();

        $context['block'] = [];
        $context['block']['columns'] = get_field('columns');

        foreach ($context['block']['columns'] as &$column) {
            if ($column['acf_fc_layout'] === 'resource') {
                $posts = $column['manual_posts'] ?: [];

                if ($column['automatic_posts']) {
                    $posts = Timber::get_posts([
                        'post_type' => $column['automatic_post_type'],
                        'posts_per_page' => 2
                    ]);
                }

                $column['posts'] = ResourceCard::convertCollection($posts);
            }

            if ($column['acf_fc_layout'] === 'default') {
                $posts = $column['manual_posts'] ?: [];

                if ($column['automatic_posts']) {
                    $posts = Timber::get_posts([
                        'post_type' => $column['automatic_post_type'],
                        'posts_per_page' => 3
                    ]);
                }

                $column['posts'] = TextCard::convertCollection($posts);
            }
        }

        $context['block']['background_colour'] = get_field('background_colour') ?: '#FFFFFF';
        $context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        // options
        $context['block']['options'] = get_field('options') ?: [];

        Timber::render('blocks/more-stories-columns.twig', $context);
    }
}
