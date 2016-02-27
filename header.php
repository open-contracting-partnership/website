<!DOCTYPE html>
<html class="no-js">

	<head>

		<!-- designed and developed by The Idea Bureau, http://theideabureau.co -->

		<script>var template_url = '<?php bloginfo('template_directory'); ?>';</script>

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

		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/libs/modernizr.js"></script>

		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/styles.css">

		<title><?php wp_title('&raquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="author" content="">
		<meta http-equiv="cleartype" content="on">

		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/favicon-194x194.png" sizes="194x194">
		<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/manifest.json">
		<link rel="mask-icon" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/safari-pinned-tab.svg" color="#323238">
		<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/img/favicons/favicon.ico">
		<meta name="msapplication-TileColor" content="#323238">
		<meta name="msapplication-TileImage" content="<?php bloginfo('template_directory'); ?>/assets/img/favicons/mstile-144x144.png">
		<meta name="msapplication-config" content="<?php bloginfo('template_directory'); ?>/assets/img/favicons/browserconfig.xml">
		<meta name="theme-color" content="#323238">

		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/libs/jquery-2.1.4.min.js"></script>

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

					<a href="/" class="logo--mobile">

						<svg>
							<use xlink:href="#ocp-logo-small" />
						</svg>

					</a>

					<svg class="mobile-menu">
						<use class="mobile-menu__open" xlink:href="#icon-menu" />
						<use class="mobile-menu__close" xlink:href="#icon-close" />
					</svg>

					<div class="header-nav--top">

						<div class="header-nav--top__item header-social">

							<ul class="button__list button__social">
								<li><a href="#" class="button"><svg><use xlink:href="#icon-facebook" /></svg></a></li>
								<li><a href="#" class="button"><svg><use xlink:href="#icon-linkedin" /></svg></a></li>
								<li><a href="#" class="button"><svg><use xlink:href="#icon-twitter" /></svg></a></li>
							</ul>

						</div>

						<?php if ( function_exists('pll_the_languages') ) : ?>

							<div class="header-nav--top__item header-language">

								<?php

									pll_the_languages([
										'dropdown' => TRUE,
										'display_names_as' => 'slug'
									]);

								?>

							</div>

						<?php endif; ?>

						<div class="header-nav--top__item header-search">
							<a href="#" class="button"><svg><use xlink:href="#icon-search" /></svg></a>
						</div>

					</div>

				</div> <!-- / .wrapper -->

				<div class="header__search">

					<div class="wrapper">

						<form action="/" method="GET">
							<input type="search" placeholder="Search" name="s" autocomplete="off">
						</form>

					</div>

					<a href="#" class="search__close"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg></a>

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

				</div>

			</nav>

		</header>

		<main>
