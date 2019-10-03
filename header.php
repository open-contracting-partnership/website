<!DOCTYPE html>
<html class="no-js">

	<head>

		<!-- developed by The Idea Bureau, http://theideabureau.co -->

		<script>document.documentElement.classList.remove('no-js');</script>

		<title><?php wp_title('&raquo;', true, 'right'); ?></title>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="author" content="">
		<meta http-equiv="cleartype" content="on">

		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/resources/img/favicons/apple-touch-icon.png?v=2">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_directory'); ?>/resources/img/favicons/favicon-32x32.png?v=2">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_directory'); ?>/resources/img/favicons/favicon-16x16.png?v=2">
		<link rel="manifest" href="<?php bloginfo('template_directory'); ?>/resources/img/favicons/site.webmanifest?v=2">
		<link rel="mask-icon" href="<?php bloginfo('template_directory'); ?>/resources/img/favicons/safari-pinned-tab.svg?v=2" color="#4d4d54">
		<meta name="msapplication-TileColor" content="#4d4d54">
		<meta name="theme-color" content="#ffffff">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php get_search_form(); ?>

		<main>
