<?php // footer.php ?>

		</main>

		<div class="site-footer">

			<div class="wrapper">

				<div class="main-footer cf"> <!-- main footer -->

					<nav class="site-footer__organisation">

						<h4>Our Organisation</h4>

						<!-- <ul class="nav nav--vertical">

							<li>
								<a href="#">Mission</a>
							</li>

							<li>
								<a href="#">Strategy</a>
							</li>

							<li>
								<a href="#">Values</a>
							</li>

							<li>
								<a href="#">Our Story</a>
							</li>

							<li>
								<a href="#">Team</a>
							</li>

							<li>
								<a href="#">Advisory board</a>
							</li>

							<li>
								<a href="#">Financing</a>
							</li>

							<li>
								<a href="#">Policies</a>
							</li>

						</ul> -->

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

						<h4>Open Contracting</h4>

						<!-- <ul class="nav nav--vertical">

							<li>
								<a href="#">What is Open Contracting</a>
							</li>

							<li>
								<a href="#">Sectors</a>
							</li>

							<li>
								<a href="#">Showcase projects</a>
							</li>

							<li>
								<a href="#">Evidence</a>
							</li>

							<li>
								<a href="#">Learning</a>
							</li>

							<li>
								<a href="#">Case studies</a>
							</li>

						</ul> -->

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

						<h4>Implement</h4>

						<!-- <ul class="nav nav--vertical">

							<li>
								<a href="#">How to implement</a>
							</li>

							<li>
								<a href="#">Data standard</a>
							</li>

							<li>
								<a href="#">Success stories</a>
							</li>

							<li>
								<a href="#">Global principles</a>
							</li>

							<li>
								<a href="#">Learning</a>
							</li>

							<li>
								<a href="#">Case studies</a>
							</li>

							<li>
								<a href="#">Resources and Tools</a>
							</li>

						</ul> -->

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

							<h4>Stay Updated</h4>

							<!-- <ul class="nav nav--vertical">

								<li>
									<a href="#">Blogs and Updates</a>
								</li>

								<li>
									<a href="#">Events</a>
								</li>

							</ul> -->

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

							<h4>Elsewhere Online</h4>

							<!-- <ul class="nav nav--vertical">

								<li>
									<a href="#">Data Standard</a>
								</li>

								<li>
									<a href="#">Community</a>
								</li>

							</ul> -->

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

							<h4>Subscribe to our newsletter</h4>

							<form action="#" class="form--dark flex-field">

								<input type="email" name="newsletter" placeholder="Enter your email">

								<button type="submit">Send</button>

							</form>

						</div>

						<nav class="site-footer__follow">

							<h4>Follow our progress</h4>

							<ul class="nav nav--horizontal">

								<li><a href="http://twitter.com/home?status=" target="_blank"><svg><use xlink:href="#icon-twitter" /></svg></a></li>
								<li><a href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank"><svg><use xlink:href="#icon-facebook" /></svg></a></li>
								<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=" target="_blank"><svg><use xlink:href="#icon-linkedin" /></svg></a></li>

							</ul>

						</nav>

						<div class="site-footer__contact">

							<h4>Contact us:</h4>

							<address>
								<span>641 S Street NW, 20001 Washington, D.C., USA<span>
								<a href="mailto:engage@open-contracting.org">engage@open-contracting.org</a>
							</address>

						</div>

					</div>

				</div> <!-- main footer -->

				<div class="sub-footer cf"> <!-- sub footer -->

					<div class="site-colophon">
						<p>This work by the Open Contracting Partnership, unless otherwise noted, is licensed under a Creative Commons Attribution 4.0 International License.</p>
					</div>

					<svg><use xlink:href="#ocp-logo-small" /></svg>

				</div> <!-- sub footer -->

			</div> <!-- / .wrapper -->

			<footer class="site-copyright"> <!-- copyright -->

				<div class="wrapper">

					<span>&copy; Open Contracting Partnership 2016</span>

					<a href="#">Site Information</a>

					<a href="#">Feedback</a>

					<a href="#">Terms</a>

					<span>Website by <a href="http://theideabureau.co">The Idea Bureau</a></span>

				</div>

			</footer> <!-- copyright -->

		</div> <!-- / .site-footer -->

		<?php wp_footer(); ?>

	</body>

</html>
