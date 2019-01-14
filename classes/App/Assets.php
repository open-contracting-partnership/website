<?php

namespace App;

class Assets
{

	public static function getFileVersion($src, $fallback_version = false) {

		// set the path to the mix manifest
		$mix_manifest_path = get_template_directory() . '/mix-manifest.json';

		// if the file doesn't exist we can't provide a new version
		if ( ! file_exists($mix_manifest_path) ) {
			return $fallback_version;
		}

		// fetch and decode the mix manifest file
		$versions = json_decode(file_get_contents($mix_manifest_path), true);

		// if the file in question doesn't exist in the file we can't provide a version
		if ( ! isset($versions[$src]) ) {
			return $fallback_version;
		}

		// fetch just the path for this item
		$path = $versions[$src];

		// if the file path doesn't contain the id query string, return
		if ( strpos($path, '?id=') === FALSE ) {
			return $fallback_version;
		}

		// we've got this far, we can now return the version
		return explode('?id=', $path)[1];

	}

	public static function registerScript($handle, $path, $deps = array(), $in_footer = false) {

		$version = self::getFileVersion($path);

		wp_register_script(
			$handle,
			get_template_directory_uri() . $path,
			$deps,
			$version,
			$in_footer
		);

	}

	public static function registerStyle($handle, $path, $deps = array()) {

		$version = self::getFileVersion($path);

		wp_register_style(
			$handle,
			get_template_directory_uri() . $path,
			$deps,
			$version
		);

	}

}
