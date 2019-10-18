<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;
use Timber\Timber;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register any app specific items into the container
     */
    public function register()
    {

    }

    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {

		add_action('admin_footer', function() {

			$context = Timber::get_context();

			$context['gutenberg_fields_visibility'] = $this->getGutenbergFieldVisibility();

			echo Timber::compile('partials/acf-gutenberg-visibility.twig', $context);
			echo Timber::compile('partials/svg-loader.twig', $context);

		});

    }

	public function getGutenbergFieldVisibility() {

		$field_groups = acf_get_field_groups();
		$field_gutenberg_visibility = [];

		foreach ( $field_groups as $group ) {

			$fields = get_posts([
				'posts_per_page' => -1,
				'post_type' => 'acf-field',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'suppress_filters' => true, // DO NOT allow WPML to modify the query
				'post_parent' => $group['ID'],
				'post_status' => 'any',
				'update_post_meta_cache' => false
			]);

			foreach ( $fields as $field ) {

				$meta = unserialize($field->post_content);

				if ( isset($meta['gutenberg_visibility']) ) {
					$field_gutenberg_visibility[$field->post_name] = $meta['gutenberg_visibility'];
				}

			}

		}

		return $field_gutenberg_visibility;

	}
}
