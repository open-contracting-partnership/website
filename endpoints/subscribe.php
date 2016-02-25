<?php

//die('OMG');


global $wp_did_header;

if ( $wp_did_header !== TRUE ) {
	require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');
}

if ( ! isset($_POST['email']) ) {
	echo json_encode(['success' => FALSE]);
	exit();
}

$success = add_subscriber($_POST['email']);

header("HTTP/1.1 200 OK");
echo json_encode(['success' => $success]);
exit();
