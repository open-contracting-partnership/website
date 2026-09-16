<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;
use Timber\Timber;

class AdminServiceProvider extends ServiceProvider
{
    private const ITEMS_PER_PAGE = 10;

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
            $context = Timber::get_context();

            Timber::render('partials/svg-loader.twig', $context);
        });

        add_filter('upload_mimes', function ($mimes) {
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        });

        $this->setDefaultItemsPerPage();
        $this->addDynamicLocationFields();
        $this->disableAcfInnerBlocksContainer();
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

    protected function setDefaultItemsPerPage(): void
    {
        add_action('admin_init', [$this, 'filterItemsPerPage']);
    }

    public function filterItemsPerPage(): void
    {
        $options = ['upload_per_page', 'edit_comments_per_page', 'plugins_per_page', 'users_per_page'];

        foreach (get_post_types(['show_ui' => true]) as $postType) {
            $options[] = "edit_{$postType}_per_page";
        }

        foreach (get_taxonomies(['show_ui' => true]) as $taxonomy) {
            // The slug is used verbatim, dashes included: edit_resource-type_per_page.
            $options[] = "edit_{$taxonomy}_per_page";
        }

        foreach ($options as $option) {
            // A saved Screen Option wins, matching how the list table falls back to its own default.
            add_filter($option, fn ($perPage) => (int) get_user_option($option) >= 1 ? $perPage : self::ITEMS_PER_PAGE);
        }
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
            if (strpos($blockName, 'acf/ocp-') === 0) {
                return false;
            }

            return $wrap;
        }, 10, 2);
    }
}
