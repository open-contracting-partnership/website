<?php

global $wp_did_header;

if ( $wp_did_header !== TRUE ) {
	require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');
}

header('HTTP/1.1 200 OK');
header('Content-Type: application/json');

$data = get_transient('map-scores');

if ( $data === false ) {
	$data = file_get_contents('https://index.okfn.org/api/entries.json');
	set_transient('map-scores', $data, HOUR_IN_SECONDS);
}

echo $data;
