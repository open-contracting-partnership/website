<?php

namespace App\Providers\Blocks;

use App\Cards\PrimaryCard;
use Timber\Timber;

class SignUpCoverServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/sign-up-cover',
                'title' => __('Sign Up'),
                'description' => __('Add a sign-up form with an image.'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'format-image',
                'enqueue_assets' => function () {

                    wp_enqueue_script('mailchimp', get_template_directory_uri() . '/dist/js/mailchimp.js', array(), false, true);

                    wp_localize_script('mailchimp', 'mailchimp_options', [
                        'root' => esc_url_raw(rest_url()),
                        'error_text' => __('An error occured, try again later.', 'ocp')
                    ]);
                },
                'keywords' => ['cover', 'sign', 'up', 'sign-up'],
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
        $context['block']['heading'] = get_field('heading') ?: 'Add primary title here&hellip;';
        $context['block']['content'] = get_field('content');
        $context['block']['form_label'] = get_field('form_label');

        // list our the region id/labels from the mailchimp tags, the worldwide
        // NOTE: mailchimp requires the tag value to be an exact string as it
        // appears in mailchimp, hence the *almost* exact key/values, but it is
        // important they remain distinct

        $context['block']['regions'] = [
            'Africa Community' => 'Africa',
            'Asia Pacific' => 'Asia Pacific',
            'Europe' => 'Europe',
            'LatAm' => 'Latin America',
            'US outreach' => 'U.S',
        ];

        $context['block']['thank_you_heading'] = get_field('thank_you_heading') ?: 'Add heading here&hellip;';
        $context['block']['thank_you_subheading'] = get_field('thank_you_subheading');

        $context['block']['background_colour'] = get_field('overlay_colour') ?: '#000000';
        // $context['block']['background_opacity'] = get_field('background_opacity') / 100;

        // $context['block']['background_colour'] = hex2rgba($context['block']['overlay_color'], $context['block']['background_opacity']);
        // $context['block']['text_colour'] = isContrastingColourLight($context['block']['background_colour']) ? '#FFF' : '#000';
        $context['block']['text_colour'] = '#FFF';
        $context['block']['text_colour'] = get_field('text_colour') ?: $context['block']['text_colour'];

        // options
        $context['block']['options'] = get_field('options') ?: [];

        $related = get_field('related_stories');

        if ($related) {
            $context['block']['related'] = PrimaryCard::convertCollection($related);
        }

        echo Timber::compile('blocks/sign-up-cover.twig', $context);
    }
}
