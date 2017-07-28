<?php // functions/media.php


 //********************
// ADD THUMBNAIL SIZES

/**
 * Creates a WordPress image size based on a width and an aspect ratio
 *
 * Example usage and image size names
 *
 * add_aspect_ratio('hero', 900, 16, 9) // hero_900
 * add_aspect_ratio('hero', 600, 16, 9) // hero_600
 * add_aspect_ratio('hero', 300, 16, 9) // hero_300
 *
 * @param string $label
 * @param integer $width
 * @param integer $aspect_width
 * @param integer $aspect_height
 */
function add_aspect_ratio($label, $width, $aspect_width, $aspect_height) {
	add_image_size($label . '_' . $width, $width, ceil(($aspect_height / $aspect_width) * $width), TRUE);
}


 //*****************
// ALLOW SVG UPLOAD

add_filter('upload_mimes', function($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
});


class imgix {

	private $url;
	private $has_error;
	private $options;

	private function getInstance() {
		return new imgix();
	}


	 //********
	// SOURCES

	static function source($source, $args = NULL) {

		// fetch the instance to continue with
		$instance = self::getInstance();

		if ( method_exists($instance, 'source_' . $source) ) {
			$instance->{'source_' . $source}($args);
		}

		return $instance;

	}

	private function source_url($url) {
		$this->url = $url;
	}

	private function source_featured() {

		// fetch the attachment id
		$image_id = get_post_thumbnail_id();

		// if the image id isn't available… set the instance as having an error
		if ( empty($image_id) ) {

			// set the instance as having an error (prevents future processing)
			$this->has_error = TRUE;

			// and return the current instance
			return $instance;

		}

		// fetch the image url from the image id
		$image_url = wp_get_attachment_image_src($image_id, 'full');

		// if the image id isn't available… set the instance as having an error
		if ( $image_url === FALSE ) {

			// set the instance as having an error (prevents future processing)
			$this->has_error = TRUE;

			// and return the current instance
			return $instance;

		}

		$this->url = $image_url[0];

	}


	 //********
	// OPTIONS

	public function options($args) {

		$this->options = $args;

		return $this;

	}


	 //**********
	// GENERATOR

	private function get_domain() {
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$domainName = $_SERVER['HTTP_HOST'].'/';
		return $protocol.$domainName;
	}

	private function generator() {

		$base_url = str_replace($this->get_domain(), '', $this->url);

		return IMGIX_BASE_URL . $base_url . '?' . http_build_query($this->options);

	}


	 //*******
	// OUTPUT

	public function url() {
		return $this->generator();
	}

}
