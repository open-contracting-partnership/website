<?php // footer.php ?>

		</main>

		<div class="site-footer">

			<div class="wrapper">

				<div class="main-footer cf"> <!-- main footer -->

					<nav class="site-footer__organisation">

						<h4><?php pll_e('About Us'); ?></h4>

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

						<h4><?php pll_e('Why Open Contracting'); ?></h4>

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

						<h4><?php pll_e('Get Started'); ?></h4>

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

							<h4><?php pll_e('Stay Updated'); ?></h4>

							<?php

								wp_nav_menu([
									'theme_location' => 'footer-stay-updated',
									'sort_column' => 'menu_order',
									'container' => 'ul',
									'menu_class' => 'nav nav--vertical'
								]);

							?>

						</nav>

						<nav>

							<h4><?php pll_e('Elsewhere Online'); ?></h4>

							<?php

								wp_nav_menu([
									'theme_location' => 'footer-elsewhere-online',
									'sort_column' => 'menu_order',
									'container' => 'ul',
									'menu_class' => 'nav nav--vertical'
								]);

							?>

						</nav>

					</div>

					<div class="site-footer__subscribe">

						<div class="site-footer__email">

							<h4><?php pll_e('Subscribe to our newsletter'); ?></h4>

							<form action="#" class="form--dark flex-field">

								<input type="email" name="newsletter" placeholder="Enter your email">

								<button type="submit"><?php pll_e('Send'); ?></button>

							</form>

						</div>

						<div class="site-footer__contact">

							<h4><?php pll_e('Contact us'); ?>:</h4>

							<address>
								<span>641 S Street NW, 20001 Washington, D.C., USA<span>
								<a href="mailto:engage@open-contracting.org">engage@open-contracting.org</a>
							</address>

						</div>

						<nav class="site-footer__follow">

							<ul class="nav nav--horizontal">

								<li><a href="https://twitter.com/opencontracting" target="_blank"><svg><use xlink:href="#icon-twitter" /></svg></a></li>
								<li><a href="https://www.facebook.com/OpenContracting" target="_blank"><svg><use xlink:href="#icon-facebook" /></svg></a></li>
								<li><a href="https://www.linkedin.com/company/open-contracting-partnership" target="_blank"><svg><use xlink:href="#icon-linkedin" /></svg></a></li>

							</ul>

						</nav>

					</div>

				</div> <!-- main footer -->

				<div class="sub-footer cf"> <!-- sub footer -->

					<div class="site-colophon">
						<p class="text--micro"><?php pll_e('This work by the Open Contracting Partnership, unless otherwise noted, is licensed under a Creative Commons Attribution 4.0 International License.'); ?></p>
					</div>

					<svg><use xlink:href="#ocp-logo-small" /></svg>

				</div> <!-- sub footer -->

			</div> <!-- / .wrapper -->

			<footer class="site-copyright"> <!-- copyright -->

				<div class="wrapper">

					<span>&copy; Open Contracting Partnership 2016</span>

					<a href="#"><?php pll_e('Site Information'); ?></a>
					<a href="#"><?php pll_e('Feedback'); ?></a>
					<a href="#"><?php pll_e('Terms'); ?></a>

					<span>Website by <a href="http://theideabureau.co">The Idea Bureau</a></span>

				</div>

			</footer> <!-- copyright -->

		</div> <!-- / .site-footer -->

		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/libs/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/main.js"></script>

<script type="text/javascript">
	(function() {
	var s = document.createElement("script");
	s.type = "text/javascript";
	s.async = true;
	s.src = '//api.usersnap.com/load/'+
        '6ddaa8e5-14cd-4b9d-8140-de7409c93f30.js';
	var x = document.getElementsByTagName('script')[0];
		x.parentNode.insertBefore(s, x);
	})();
</script>

<script type="text/javascript">
 var _usersnapconfig = {
     emailBox: true,
     emailRequired: false,
     commentBox: true,
     commentRequired: false,
     commentBoxPlaceholder: 'Please enter your mood here.',
     emailBoxValue: '[NAME]@theideabureau.co',
     tools: ['pen', 'blackout', 'note', 'highlight', 'arrow', 'pixelruler', 'comment']
 };
</script>

		<?php wp_footer(); ?>

	</body>

</html>
