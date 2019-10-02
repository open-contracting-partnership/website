<?php

namespace App;

class Media
{

	static function has_post_thumbnail($post = null) {
		return !! self::get_post_thumbnail_id($post);
	}

	static function get_post_thumbnail_id($post = null) {

		// generic post thumbnail checks
		if ( $thumbnail_id = get_post_thumbnail_id($post) ) {
			return $thumbnail_id;
		}

		// report thumbnail check (pdf cover)
		if ( $resource_thumbnail_id = self::get_resource_thumbnail_id($post) ) {
			return $resource_thumbnail_id;
		}

		return FALSE;

	}

	static function get_resource_thumbnail_id($post) {

		if ( get_post_type($post) === 'resource' ) {

			if ( $resources = get_field('resource') ) {

				foreach ( $resources as $resource ) {

					if ( $resource['acf_fc_layout'] == "file" ) {

						$file = $resource['file'];
						$extension = pathinfo($file['url'], PATHINFO_EXTENSION);

						if ( $extension === 'pdf' ) {

							if ( wp_get_attachment_image($file['id'], 'large') ) {
								return $file['id'];
							}

						}

					}

				}

			}

		}

	}

	static function get_attachment_image_src($size = 'thumbnail') {

		$thumb_id = self::get_post_thumbnail_id();

		return wp_get_attachment_image_src($thumb_id, $size);

	}

	static function the_post_thumbnail($size = 'post-thumbnail', $attr = '') {
	    echo self::get_the_post_thumbnail(null, $size, $attr);
	}

	static function get_the_post_thumbnail($post = null, $size = 'post-thumbnail', $attr = '') {

	    $post = get_post($post);

	    if ( ! $post ) {
	        return '';
	    }

	    $post_thumbnail_id = get_post_thumbnail_id( $post );

		if ( $thumb_id = self::get_resource_thumbnail_id($post) ) {
			$post_thumbnail_id = $thumb_id;
			$size = 'large';
		}

	    /**
	     * Filters the post thumbnail size.
	     *
	     * @since 2.9.0
	     *
	     * @param string|array $size The post thumbnail size. Image size or array of width and height
	     *                           values (in that order). Default 'post-thumbnail'.
	     */
	    $size = apply_filters( 'post_thumbnail_size', $size );

	    if ( $post_thumbnail_id ) {

	        /**
	         * Fires before fetching the post thumbnail HTML.
	         *
	         * Provides "just in time" filtering of all filters in wp_get_attachment_image().
	         *
	         * @since 2.9.0
	         *
	         * @param int          $post_id           The post ID.
	         * @param string       $post_thumbnail_id The post thumbnail ID.
	         * @param string|array $size              The post thumbnail size. Image size or array of width
	         *                                        and height values (in that order). Default 'post-thumbnail'.
	         */
	        do_action( 'begin_fetch_post_thumbnail_html', $post->ID, $post_thumbnail_id, $size );
	        if ( in_the_loop() )
	            update_post_thumbnail_cache();
	        $html = wp_get_attachment_image( $post_thumbnail_id, $size, false, $attr );

	        /**
	         * Fires after fetching the post thumbnail HTML.
	         *
	         * @since 2.9.0
	         *
	         * @param int          $post_id           The post ID.
	         * @param string       $post_thumbnail_id The post thumbnail ID.
	         * @param string|array $size              The post thumbnail size. Image size or array of width
	         *                                        and height values (in that order). Default 'post-thumbnail'.
	         */
	        do_action( 'end_fetch_post_thumbnail_html', $post->ID, $post_thumbnail_id, $size );

	    } else {
	        $html = '';
	    }
	    /**
	     * Filters the post thumbnail HTML.
	     *
	     * @since 2.9.0
	     *
	     * @param string       $html              The post thumbnail HTML.
	     * @param int          $post_id           The post ID.
	     * @param string       $post_thumbnail_id The post thumbnail ID.
	     * @param string|array $size              The post thumbnail size. Image size or array of width and height
	     *                                        values (in that order). Default 'post-thumbnail'.
	     * @param string       $attr              Query string of attributes.
	     */
	    return apply_filters( 'post_thumbnail_html', $html, $post->ID, $post_thumbnail_id, $size, $attr );
	}

}
