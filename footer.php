<?php // footer.php ?>

		</main>

		<div class="site-footer">

			<div class="wrapper">

				<div class="main-footer cf"> <!-- main footer -->

					<nav class="site-footer__organisation">

						<h4><?php _e('About Us', 'ocp'); ?></h4>

						<?php

							wp_nav_menu([
								'theme_location' => 'footer-our-organisation',
								'sort_column' => 'menu_order',
								'container' => 'ul',
								'menu_class' => 'nav nav--vertical'
							]);

						?>

					</nav>

					<nav class="site-footer__contracting">

						<h4><?php _e('Why Open Contracting', 'ocp'); ?></h4>

						<?php

							wp_nav_menu([
								'theme_location' => 'footer-open-contracting',
								'sort_column' => 'menu_order',
								'container' => 'ul',
								'menu_class' => 'nav nav--vertical'
							]);

						?>

					</nav>

					<nav class="site-footer__implement">

						<h4><?php _e('Get Started', 'ocp'); ?></h4>

						<?php

							wp_nav_menu([
								'theme_location' => 'footer-implement',
								'sort_column' => 'menu_order',
								'container' => 'ul',
								'menu_class' => 'nav nav--vertical'
							]);

						?>

					</nav>

					<div class="site-footer__updates">

						<nav>

							<h4><?php _e('Stay Updated', 'ocp'); ?></h4>

							<?php

								wp_nav_menu([
									'theme_location' => 'footer-stay-updated',
									'sort_column' => 'menu_order',
									'container' => 'ul',
									'menu_class' => 'nav nav--vertical'
								]);

							?>

						</nav>

					</div>

					<div class="site-footer__subscribe">

						<div class="site-footer__email">

							<h4><?php _e('Subscribe to our newsletter', 'ocp'); ?></h4>
							<p><button class="js-subscribe-footer / button button--white"><?php _e('Get our newsletter', 'ocp'); ?></button></p>

						</div>

						<div class="site-footer__contact">

							<h4><?php _e('Contact us', 'ocp'); ?>:</h4>

							<address>
								<a href="mailto:engage@open-contracting.org">engage@open-contracting.org</a>
								<span>Open Contracting Partnership, 641 S Street NW, 20001 Washington, D.C., USA<span>
							</address>

						</div>

						<nav class="site-footer__follow">

							<ul class="nav nav--horizontal">

								<?php if ( $twitter_url = get_field('twitter_url', 'options') ) : ?>
									<li><a href="<?php echo $twitter_url; ?>" target="_blank"><svg><use xlink:href="#icon-twitter" /></svg></a></li>
								<?php endif; ?>

								<?php if ( $facebook_url = get_field('facebook_url', 'options') ) : ?>
									<li><a href="<?php echo $facebook_url; ?>" target="_blank"><svg><use xlink:href="#icon-facebook" /></svg></a></li>
								<?php endif; ?>

								<?php if ( $linkedin_url = get_field('linkedin_url', 'options') ) : ?>
									<li><a href="<?php echo $linkedin_url; ?>" target="_blank"><svg><use xlink:href="#icon-linkedin" /></svg></a></li>
								<?php endif; ?>

							</ul>

						</nav>

					</div>

				</div> <!-- main footer -->

				<div class="sub-footer cf"> <!-- sub footer -->

					<div class="site-colophon">
						<p class="text--micro"><?php _e('This work by the Open Contracting Partnership, unless otherwise noted, is licensed under a Creative Commons Attribution 4.0 International License.', 'ocp'); ?></p>
					</div>

					<svg><use xlink:href="#ocp-logo-small" /></svg>

				</div> <!-- sub footer -->

			</div> <!-- / .wrapper -->

			<footer class="site-copyright"> <!-- copyright -->

				<div class="wrapper">

					<span>Open Contracting Partnership <?php echo date('Y'); ?></span>

					<a href="/terms-of-use/"><?php _e('Terms', 'ocp'); ?></a>

					<span>Website by <a href="https://theideabureau.co">The Idea Bureau</a></span>

				</div>

			</footer> <!-- copyright -->

		</div> <!-- / .site-footer -->

		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/dist/js/main.js?v=<?php echo wp_get_theme()->Version; ?>"></script>

		<script>

			var ajax = new XMLHttpRequest();
			ajax.open('GET', '<?php echo get_bloginfo('template_directory'); ?>/dist/svg/icons.svg?v=<?php echo wp_get_theme()->Version; ?>', true);
			ajax.send();
			ajax.onload = function(e) {

				var div = document.createElement('div');
				div.style.display = 'none';
				div.style.visibility = 'hidden';
				div.innerHTML = ajax.responseText;
				document.body.insertBefore(div, document.body.childNodes[0]);

			}

		</script>

		<?php wp_footer(); ?>

		<!-- Hotjar Tracking Code for Open Contracting Partnership -->
		<script>
			(function(h,o,t,j,a,r){
				h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
				h._hjSettings={hjid:109763,hjsv:5};
				a=o.getElementsByTagName('head')[0];
				r=o.createElement('script');r.async=1;
				r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
				a.appendChild(r);
			})(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
		</script>

		<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script>

		<script>

			function showMailingPopUp() {
			    require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us12.list-manage.com","uuid":"4257477995e0a1fa5cb6587b2","lid":"fc9ec0e34b"}) })
			    document.cookie = "MCPopupClosed=;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;";
			};

		</script>

	</body>

</html>
