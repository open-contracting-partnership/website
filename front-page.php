<?php // front-page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="homepage-hero">

		<div class="wrapper">

			<div class="homepage-cta / band band--section">

				<div class="highlight-text / band">
					<p><?php the_field('strapline'); ?></p>
				</div>

				<a href="" class="button button--white">About Our Work</a>
				<a href="" class="button button--white">Visit the Data Standard</a>

			</div> <!-- homepage-cta -->

		</div>

	</div>

	<section class="homepage-contracting / band band--thick / island island--thick island--dark">

		<div class="wrapper">

			<div class="homepage-title">
				<h1>Public contracting</h1>
				<h2>The number one corruption risk in government</h2>
			</div>

			<?php if ( have_rows('statistics') ) : ?>

				<div class="stat__container">

					<?php while ( have_rows('statistics') ) : the_row(); ?>

						<div class="stat-module">
							<span><?php the_sub_field('stat'); ?></span>
							<p><?php the_sub_field('copy'); ?></p>
						</div>

					<?php endwhile; ?>

				</div> <!-- / .stat-container -->

			<?php endif; ?>

		</div>

	</section> <!-- stat-modules -->

	<div class="wrapper">

		<div class="band band--thicker">

			<div class="homepage-blogs">

				<section>

					<h3 class="border-top">Recent Blogs</h3>

					<?php

						$recent_posts = new query_loop([
							'post_type' => 'post',
							'posts_per_page' => 3
						]);

					?>

					<?php foreach ( $recent_posts as $recent_post ) : ?>

						<a href="<?php the_permalink(); ?>" class="post-object post-object--horizontal / media">

							<div href="#" class="post-object__media / media__object">
								<?php the_post_thumbnail('hemo_horizontal'); ?>
							</div>

							<div class="post-object__content / media__body">
								<div>
									<h4><?php the_title(); ?></h4>
								</div>
								<p>By <?php the_authors(); ?></p>
							</div>

						</a>

					<?php endforeach; ?>

				</section>

			</div> <!-- homepage-blogs -->

			<div class="homepage-spotlight">

				<section>

					<h3 class="border-top">Spotlight</h3>

					<a href="#" class="post-object post-object--vertical post-object--spotlight">

						<div class="post-object__media">

							<img src="http://placehold.it/459x235" alt="">

							<div class="post-object--spotlight__title">
								<span class="post-object__tag">Projects</span>
								<h4>Help us define our openness</h4>
							</div>

						</div>

						<div class="post-object__content">
							<p>Open is part of our name and game at the Open Contracting Partnership. This means, open is at the core of our institution. It is our mission. It is one of our core values. If we want public procurement to be open, we have to be open ourselves.</p>
						</div>

					</a>

				</section>

			</div> <!-- homepage-spotlight -->

			<div class="homepage-implement">

				<section>

					<div class="heading-highlight">
						<h3>Implement Open Contracting</h3>
					</div>

					<span>Learn how to implement open contracting or use contracting data.</span>

					<ul class="cta-list">
						<li><a href="#">Showcases and evidence</a></li>
						<li><a href="#">How to get started</a></li>
						<li><a href="#">Global guidelines</a></li>
					</ul>

				</section>

			</div> <!-- homepage-implement -->

		</div>

		<section class="homepage-filter / band band--extra-thick">

			<a href="#" class="homepage-filter__button / band band--thicker">Filter Blogs &amp; Updates</a>

			<div class="homepage-filter__items">

				<div class="homepage-filter__twitter">
					<p>Interesting job over at <b>@engnroom</b>  to coordinate a regional program on transparency, technology and <b>#opendata</b> <a href="https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/">https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/</a></p>
				</div>

				<div class="homepage-filter__twitter">
					<p>Interesting job over at <b>@engnroom</b>  to coordinate a regional program on transparency, technology and <b>#opendata</b> <a href="https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/">https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/</a></p>
				</div>

				<div class="homepage-filter__twitter">
					<p>Interesting job over at <b>@engnroom</b>  to coordinate a regional program on transparency, technology and <b>#opendata</b> <a href="https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/">https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/</a></p>
				</div>

				<div class="homepage-filter__twitter">
					<p>Interesting job over at <b>@engnroom</b>  to coordinate a regional program on transparency, technology and <b>#opendata</b> <a href="https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/">https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/</a></p>
				</div>

				<div class="homepage-filter__twitter">
					<p>Interesting job over at <b>@engnroom</b>  to coordinate a regional program on transparency, technology and <b>#opendata</b> <a href="https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/">https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/</a></p>
				</div>

				<div class="homepage-filter__twitter">
					<p>Interesting job over at <b>@engnroom</b>  to coordinate a regional program on transparency, technology and <b>#opendata</b> <a href="https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/">https://www.theengineroom.org/were-hiring-a-regional-matchbox-lead-for-latin-america-maybe-its-you/</a></p>
				</div>

			</div>

		</section>

		<section class="homepage-map / band band--section">

			<div class="l-7 g-first">
				<img src="http://placehold.it/459x400" alt="">
			</div>

			<div class="l-5 g-last">

				<h3>Worldwide</h3>

				<span>Learn how to implement open contracting or use contracting data.</span>

				<ul class="cta-list">
					<li><a href="#">World Overview</a></li>
					<li><a href="#">Showcase on Ukraine</a></li>
					<li><a href="#">Showcase on Mexico</a></li>
				</ul>

			</div>

		</section>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
