<?php

namespace App\Providers;

use App\Assets;
use Rareloop\Lumberjack\Providers\ServiceProvider;
use Timber\Timber;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register any app specific items into the container
     */
    public function register(): void
    {
    }

    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('init', [$this, 'updatePostObjectLabel']);
        add_action('admin_menu', [$this, 'updatePostMenuLabel']);

        add_action('admin_footer', function () {
            Timber::render('partials/svg-loader.twig', ['theme' => new \Timber\Theme()]);
        });

        add_filter('upload_mimes', function ($mimes) {
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        });

        $this->addDynamicLocationFields();
        $this->disableAcfInnerBlocksContainer();
        $this->handleAcfImageFields();
        $this->queueAdminAssets();
    }

    public function updatePostMenuLabel(): void
    {
        global $menu;

        $menu[5][0] = 'Blog';
    }

    public function updatePostObjectLabel(): void
    {
        global $wp_post_types;

        $labels = &$wp_post_types['post']->labels;
        $labels->name = _x('Blog', 'Blog custom post type (plural)', 'ocp');
        $labels->singular_name = _x('Blog', 'Blog custom post type (singular)', 'ocp');
        $labels->add_new = 'Add Blog Post';
        $labels->add_new_item = 'Add Blog Post';
        $labels->edit_item = 'Edit Blog Post';
        $labels->new_item = 'Blog';
        $labels->view_item = 'View Blog Post';
        $labels->search_items = 'Search blog posts';
        $labels->not_found = 'No blog posts found';
        $labels->not_found_in_trash = 'No blog posts found in Trash';
    }

    protected function addDynamicLocationFields(): void
    {
        add_filter('acf/load_field/key=field_69e8d4dd860d8', [$this, 'setAcfCountryLocationValues']);
        add_filter('acf/load_field/key=field_69e8d534860d9', [$this, 'setAcfCountryLocationValues']);
    }

    public static function setAcfCountryLocationValues($field)
    {
        $countryJson = get_template_directory() . '/node_modules/flag-icons/country.json';
        $countries = collect(json_decode(file_get_contents($countryJson), true));

        $field['choices'] = $countries->mapWithKeys(function ($country) {
            return [$country['code'] => $country['name']];
        })->toArray();

        return $field;
    }

    protected function disableAcfInnerBlocksContainer(): void
    {
        add_filter('acf/blocks/wrap_frontend_innerblocks', function ($wrap, $blockName) {
            $ignoredBlocks = [
                'acf/ocp-grid-section',
            ];

            if (in_array($blockName, $ignoredBlocks)) {
                return $wrap;
            }

            if (strpos($blockName, 'acf/ocp-') === 0) {
                return false;
            }

            return $wrap;
        }, 10, 2);
    }

    protected function handleAcfImageFields(): void
    {
        add_filter('acf/format_value/type=image', function ($value, $post_id, $field) {
            return Timber::get_image($value);
        }, 999, 3);

        add_filter('acf/format_value/type=gallery', function ($value, $post_id, $field) {
            return collect($value ?: [])
                ->map(function ($image) {
                    return Timber::get_image($image);
                })
                ->toArray();
        }, 999, 3);
    }

    protected function queueAdminAssets(): void
    {
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_script('admin-scripts', Assets::getUrl('js/admin-VITE.js'), ['acf-input']);
        });
    }
}
