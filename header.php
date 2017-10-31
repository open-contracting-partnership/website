<!DOCTYPE html>
<html class="no-js">

	<head>

		<!-- designed and developed by The Idea Bureau, http://theideabureau.co -->

		<script>var template_url = '<?php bloginfo('template_directory'); ?>';</script>

		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/libs/modernizr.js"></script>

		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/styles.min.css">

		<script src="https://use.typekit.net/xpw3jps.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>

		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/public/js/libs/css-element-queries/src/ResizeSensor.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/public/js/libs/css-element-queries/src/ElementQueries.js"></script>

		<script>

			//attaches to DOMLoadContent
			ElementQueries.listen();

		</script>

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

		<script src="<?php bloginfo('template_directory'); ?>/assets/js/libs/jquery-2.1.4.min.js"></script>
		<script src="<?php bloginfo('template_directory'); ?>/assets/js/libs/vue.min.js"></script>

		<script src="<?php bloginfo('template_directory'); ?>/public/js/libs/slick-slider/slick.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/public/js/libs/slick-slider/slick.css">

		<?php wp_head(); ?>

		<script type="text/javascript">

			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-35677147-1']);
			_gaq.push(['_trackPageview']);

			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();

		</script>

		<!-- Hotjar Tracking Code for Open Contracting Partnership -->
		<script>
			(function(h,o,t,j,a,r){
				h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
				h._hjSettings={hjid:510028,hjsv:5};
				a=o.getElementsByTagName('head')[0];
				r=o.createElement('script');r.async=1;
				r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
				a.appendChild(r);
			})(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
		</script>

	</head>

	<body <?php body_class(basename(get_permalink())); ?>>

		<div style="display: none; visibility: hidden;">
			<?php require(get_template_directory() . '/assets/img/icons.svg'); ?>
		</div>

		<header class="site-header">

			<div class="site-header__top">

				<div class="wrapper">

					<a href="<?php echo get_home_url(); ?>" class="logo">

						<svg>
							<use xlink:href="#ocp-logo" />
						</svg>

					</a>

					<a href="<?php echo get_home_url(); ?>" class="logo--mobile">

						<svg>
							<use xlink:href="#ocp-logo-small" />
						</svg>

					</a>

					<svg class="mobile-menu">
						<use class="mobile-menu__open" xlink:href="#icon-menu" />
						<use class="mobile-menu__close" xlink:href="#icon-close" />
					</svg>

					<div class="header-nav__side">

						<div class="header-nav__side-item / header-language">
							<?php do_action('wpml_add_language_selector'); ?>
						</div>

						<div class="header-nav__side-item / header-social">

							<ul class="button__list button__social">

								<?php if ( $facebook_url = get_field('facebook_url', 'options') ) : ?>
									<li><a class="button" href="<?php echo $facebook_url; ?>" target="_blank"><svg><use xlink:href="#icon-facebook" /></svg></a></li>
								<?php endif; ?>

								<?php if ( $linkedin_url = get_field('linkedin_url', 'options') ) : ?>
									<li><a class="button" href="<?php echo $linkedin_url; ?>" target="_blank"><svg><use xlink:href="#icon-linkedin" /></svg></a></li>
								<?php endif; ?>

								<?php if ( $twitter_url = get_field('twitter_url', 'options') ) : ?>
									<li><a class="button" href="<?php echo $twitter_url; ?>" target="_blank"><svg><use xlink:href="#icon-twitter" /></svg></a></li>
								<?php endif; ?>

							</ul>

						</div>

						<div class="header-nav__side-item / header-search">
							<a href="#" class="button"><svg><use xlink:href="#icon-search" /></svg></a>
						</div>

					</div>

				</div> <!-- / .wrapper -->

				<div class="header__search">

					<div class="wrapper">

						<form action="/" method="GET">
							<input type="search" placeholder="Search" name="s" autocomplete="off">
						</form>

						<a href="#" class="search__close"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg></a>

					</div>

				</div>

			</div>

			<nav class="primary-nav">

				<div class="wrapper">

					<?php

						// before outputting the standard menu, consider the secondary navigation
						$secondary_nav = OCP_Nav::prepare_primary_nav();

						// output the entire multi-level navigation
						// we won't show it all, but on mobile it's used for the slide out

						wp_nav_menu([
							'theme_location' => 'header-primary',
							'sort_column' => 'menu_order',
							'container' => 'ul',
							'menu_class' => 'nav nav--horizontal',
							'depth' => 2
						]);

					?>

				</div>

			</nav> <!-- / .primary-nav -->

			<?php if ( ! empty($secondary_nav) ) : ?>

				<nav class="secondary-nav">

					<div class="wrapper">

						<ul class="nav nav--horizontal">

							<li class="nav__home"><a href="/">&nbsp;</a></li>

							<?php foreach ( $secondary_nav as $menu_item ) : ?>
								<li class="<?php echo implode(' ', $menu_item->classes); ?>"><a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a></li>
							<?php endforeach; ?>

						</ul>

					</div> <!-- / .wrapper -->

				</nav> <!-- / .secondary-nav -->

			<?php endif; ?>

		</header>

		<main>
