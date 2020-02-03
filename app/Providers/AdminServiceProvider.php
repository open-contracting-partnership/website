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

		add_action('init', [$this, 'updatePostObjectLabel']);
		add_action('admin_menu', [$this, 'updatePostMenuLabel']);

		add_action('admin_footer', function() {

			$context = Timber::get_context();

			$context['gutenberg_fields_visibility'] = $this->getGutenbergFieldVisibility();

			echo Timber::compile('partials/acf-gutenberg-visibility.twig', $context);
			echo Timber::compile('partials/svg-loader.twig', $context);

		});

		add_filter('upload_mimes', function($mimes) {
			$mimes['svg'] = 'image/svg+xml';
			return $mimes;
		});

	}

	public function updatePostMenuLabel() {
		global $menu;
		global $submenu;
		$menu[5][0] = 'Blog';
	}

	public function updatePostObjectLabel() {
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
