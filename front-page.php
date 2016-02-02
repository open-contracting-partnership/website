<?php // front-page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="wrapper">

		<div class="homepage-cta / band band--section">

			<div class="highlight-text / band">
				<p><?php the_field('strapline'); ?></p>
			</div>

			<a href="" class="button button--white">About Our Work</a>
			<a href="" class="button button--white">Visit the Data Standard</a>

		</div> <!-- homepage-cta -->

		<section class="g-break / band band--section">

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

		</section> <!-- stat-modules -->

		<div class="band band--thicker">

			<div class="homepage-blogs / l-4 g-first">

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
								<img src="http://placehold.it/122x154" alt="">
							</div>

							<div class="post-object__content / media__body">
								<h4><?php the_title(); ?></h4>
								<p>By <?php the_authors(); ?></p>
							</div>

						</a>

					<?php endforeach; ?>

				</section>

			</div> <!-- homepage-blogs -->

			<div class="homepage-spotlight / l-4">

				<section>

					<h3 class="border-top">Spotlight</h3>

					<a href="#" class="post-object post-object--vertical">

						<div class="post-object__media">
							<img src="http://placehold.it/459x235" alt="">
							<span class="post-object__tag">Projects</span>
						</div>

						<div class="post-object__content">
							<h4>Help us define our openness</h4>
							<p>Open is part of our name and game at the Open Contracting Partnership. This means, open is at the core of our institution. It is our mission. It is one of our core values. If we want public procurement to be open, we have to be open ourselves.</p>
						</div>

					</a>

				</section>

			</div> <!-- homepage-spotlight -->

			<div class="homepage-implement / l-3">

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

		<section class="g-break">

			<a href="" class="homepage-filter / band band--thicker">Filter Blogs &amp; Updates</a>

			<div class="l-4 g-first"></div>
			<div class="l-4"></div>
			<div class="l-4 g-last"></div>
			<div class="l-4 g-first"></div>
			<div class="l-4"></div>
			<div class="l-4 g-last"></div>

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
