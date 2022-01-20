<?php

/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Page;
use Timber\Timber;

/**
 * Class names can not start with a number so the 404 controller has a special cased name
 */
class Error404Controller extends Controller
{
    public function handle()
    {

        $context = Timber::get_context();
        $page = new Page(8300);

        $context['post'] = $page;
        $context['title'] = $page->title;
        $context['content'] = $page->content;
        $context['hide_title'] = $page->hide_title;

        return new TimberResponse('templates/page.twig', $context, 404);
    }
}
