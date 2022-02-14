<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Page;
use Timber\Timber;

class PageWorldwideController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $page = new Page();

        // localise the script only *after* the scripts are queued up
        add_action('wp_enqueue_scripts', function () use ($page) {

            wp_localize_script('page-worldwide', 'content', [
                'title' => $page->title,
                'content' => str_replace(["\n", "\r"], '', apply_filters('the_content', $page->content)),
                'table_view' => __('Table view', 'ocp'),
                'map_view' => __('Map view', 'ocp'),
                'map' => array(
                    'filter' => __('Filter Options', 'ocp'),
                    'close' => __('Close Filter', 'ocp'),
                ),
                'filter' => array(
                    'all' => __('Active countries', 'ocp'),
                    'ocds' => __('Using the Open Contracting Data Standard', 'ocp'),
                    'ocds_status' => __('Status:', 'ocp'),
                    'ocds_ongoing' => __('Ongoing', 'ocp'),
                    'ocds_implementation' => __('Implementation', 'ocp'),
                    'ocds_historic' => __('Historic', 'ocp'),
                    'commitments' => __('With documented commitments', 'ocp'),
                    'contract' => __('With innovation in contracting monitoring & data use', 'ocp'),
                ),
                'country' => array(
                    'ocds' => __('Using the Open Contracting Data Standard', 'ocp'),
                    'commitments' => __('Documented commitments', 'ocp'),
                    'contract' => __('Innovation in contract monitoring & data use', 'ocp'),
                    'impact_stories' => __('Impact Stories', 'ocp'),
                    'no_data' => __('No data available', 'ocp'),
                    'improve_data' => __('Improve this data', 'ocp'),
                ),
                'search' => array(
                    'placeholder' => __('Find Country', 'ocp'),
                    'no_data' => __('(No data yet)', 'ocp')
                )
            ]);
        }, 11);

        return new TimberResponse('templates/worldwide.twig', $context);
    }
}
