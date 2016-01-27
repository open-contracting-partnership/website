<!DOCTYPE html>
<html class="no-js">

	<head>

		<!-- designed and developed by The Idea Bureau, http://theideabureau.co -->

		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/styles.css">

		<title><?php wp_title(); ?></title>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="author" content="">
		<meta http-equiv="cleartype" content="on">

		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/favicon.ico" type="image/x-icon" /> -->
		<!-- <link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon.png" /> -->
		<!-- <link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-57x57.png" /> -->
		<!-- <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-72x72.png" /> -->
		<!-- <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-76x76.png" /> -->
		<!-- <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-114x114.png" /> -->
		<!-- <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-120x120.png" /> -->
		<!-- <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-144x144.png" /> -->
		<!-- <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-152x152.png" /> -->

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(basename(get_permalink())); ?>>

		<div style="display: none; visibility: hidden;">
			<?php require(get_template_directory() . '/assets/img/icons.svg'); ?>
		</div>

		<header class="site-header / band band--section">

			<div class="wrapper">

				<a href="/" class="logo">

					<svg>
						<use xlink:href="#ocp-logo" />
					</svg>

				</a>

				<div class="header-nav--top">

					<div class="header-nav--top__item header-social">

						<ul class="button__list">
							<li><a href="#" class="button">f</a></li>
							<li><a href="#" class="button">in</a></li>
							<li><a href="#" class="button">t</a></li>
						</ul>

						<a href="#">Contact &amp; Helpdesk</a>

					</div>

					<div class="header-nav--top__item header-language">
						<select class="" name="">
							<option value="">English</option>
						</select>
					</div>

					<div class="header-nav--top__item header-search">
						<a href="#" class="button">Search</a>
					</div>

				</div>

				<nav class="primary-nav">

					<?php

						wp_nav_menu([
							'theme_location' => 'header-primary',
							'sort_column' => 'menu_order',
							'container' => 'ul',
							'menu_class' => 'nav nav--horizontal',
							'depth' => 1
						]);

					?>

					<?php

						wp_nav_menu([
							'theme_location' => 'header-secondary',
							'sort_column' => 'menu_order',
							'container' => 'ul',
							'menu_class' => 'nav nav--horizontal',
							'depth' => 1
						]);

					?>

				</nav>

			</div>

		</header>

		<main class="wrapper">
