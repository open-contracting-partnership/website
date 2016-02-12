<!DOCTYPE html>
<html class="no-js">

	<head>

		<!-- designed and developed by The Idea Bureau, http://theideabureau.co -->

		<script>
		  (function(d) {
		    var config = {
		      kitId: 'xpw3jps',
		      scriptTimeout: 3000,
		      async: true
		    },
		    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
		  })(document);
		</script>

		<script type="text/javascript" src="<?php echo bloginfo('template_directory'); ?>/assets/js/libs/modernizr.js"></script>

		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/styles.css">

		<title><?php wp_title('&raquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

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

		<header class="site-header">

			<div class="site-header__top">

				<div class="wrapper">

					<a href="/" class="logo">

						<svg>
							<use xlink:href="#ocp-logo" />
						</svg>

					</a>

					<div class="header-nav--top">

						<div class="header-nav--top__item header-social">

							<ul class="button__list button__social">
								<li><a href="#" class="button"><svg><use xlink:href="#icon-facebook" /></svg></a></li>
								<li><a href="#" class="button"><svg><use xlink:href="#icon-linkedin" /></svg></a></li>
								<li><a href="#" class="button"><svg><use xlink:href="#icon-twitter" /></svg></a></li>
							</ul>

							<a href="/contact"><?php pll_e('Contact & Helpdesk'); ?></a>

						</div>

						<div class="header-nav--top__item header-language">

							<?php

								pll_the_languages([
									'dropdown' => TRUE,
									'display_names_as' => 'slug'
								]);

							?>

						</div>

						<div class="header-nav--top__item header-search">
							<a href="#" class="button"><svg><use xlink:href="#icon-search" /></svg></a>
						</div>

					</div>

				</div> <!-- / .wrapper -->

				<div class="header__search">

					<div class="wrapper">

						<form action="/" method="GET">
							<input type="search" placeholder="Search" name="s" />
						</form>

					</div>

				</div>

				<div class="header-search">
					<a href="#" class="button"><svg><use xlink:href="#icon-search" /></svg></a>
				</div>

			</div>

			<nav class="primary-nav">

				<div class="wrapper">

					<?php

						wp_nav_menu([
							'theme_location' => 'header-primary',
							'sort_column' => 'menu_order',
							'container' => 'ul',
							'menu_class' => 'nav nav--horizontal',
							'depth' => 2
						]);

					?>

					<?php

						wp_nav_menu([
							'theme_location' => 'header-secondary',
							'sort_column' => 'menu_order',
							'container' => 'ul',
							'menu_class' => 'nav nav--horizontal',
							'depth' => 2
						]);

					?>

				</div>

			</nav>

		</header>

		<main>
