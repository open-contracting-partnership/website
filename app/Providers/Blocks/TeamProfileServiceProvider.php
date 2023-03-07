<?php

namespace App\Providers\Blocks;

use App\Cards\TextCard;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class TeamProfileServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/team-profile',
                'title' => __('Team Profile'),
                'description' => __('Display a list of team members.'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'format-image',
                'enqueue_assets' => function () {

                    wp_enqueue_script('block-team-profile', get_template_directory_uri() . '/dist/js/block-team-profile.js', ['manifest'], false, true);

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

    public function render()
    {
        $context = Timber::get_context();

        $context['block'] = [];
        $context['block']['team'] = get_field('team_members');

        $context['block']['team'] = array_map(function ($person) {

            // set the slug
            $person['slug'] = sanitize_title($person['name']);

            // add any blog posts
            $person['posts'] = array();

            if ($person['wordpress_author']) {
                $person['posts'] = TextCard::convertCollection(Post::query([
                    'author' => $person['wordpress_author'],
                    'posts_per_page' => 3
                ]));
            }

            return $person;
        }, $context['block']['team']);

        // options
        $context['block']['options'] = get_field('options') ?: [];

        echo Timber::compile('blocks/team-profile.twig', $context);
    }
}
