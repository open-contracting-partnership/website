<?php // front-page.php ?>

<?php get_header(); ?>

	<?php/* if ( have_posts() ) : the_post(); ?>

		<h1><?php the_title(); ?></h1>

		<?php the_content(); ?>

	<?php endif; */?>

	<div class="wrapper">

		<div class="homepage-cta / band band--section">

			<div class="highlight-text / band">
				<p>The Open Contracting Partnership connects governments, civil society and business to open up and monitor public contracting. The result: Better deals, less fraud and corruption, higher-quality services, and a fairer business environment.</p>
			</div>

			<a href="" class="button">About Our Work</a>
			<a href="" class="button">Visit the Data Standard</a>

		</div> <!-- homepage-cta -->

		<section class="g-break / band band--section">

			<div class="homepage-title">
				<h1>Public contracting</h1>
				<h2>The number one corruption risk in government</h2>
			</div>

			<div class="stat-module / l-4 g-first">
				<span>$9.5 Trillion</span>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed sapien quam. Sed dapibus est id enim facilisis, at posuere turpis adipiscing. Quisque sit amet dui dui.</p>
			</div>

			<div class="stat-module / l-4">
				<span>40</span>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed sapien quam. Sed dapibus est id enim facilisis, at posuere turpis adipiscing. Quisque sit amet dui dui.</p>
			</div>

			<div class="stat-module / l-4 g-last">
				<span>4</span>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed sapien quam. Sed dapibus est id enim facilisis, at posuere turpis adipiscing. Quisque sit amet dui dui.</p>
			</div>

		</section> <!-- stat-modules -->

		<div class="homepage-blogs / l-4 g-first">

			<section>

				<h3 class="border-top">Recent Blogs</h3>

				<article class="post-object post-object--horizontal / media">

					<div class="post-object__media / media__object">
						<img src="http://placehold.it/122x154" alt="">
					</div>

					<div class="post-object__content / media__body">
						<h3>Why Finance Ministers should care about open contracting</h3>
						<p>By Georg Neumann <span>C 1</span></p>
					</div>

				</article>

				<article class="post-object post-object--horizontal / media">

					<div class="post-object__media / media__object">
						<img src="http://placehold.it/122x154" alt="">
					</div>

					<div class="post-object__content / media__body">
						<h3>Open Contracting at the OGP Summit</h3>
						<p>By Georg Neumann <span>C 1</span></p>
					</div>

				</article>

				<article class="post-object post-object--horizontal / media">

					<div class="post-object__media / media__object">
						<img src="http://placehold.it/122x154" alt="">
					</div>

					<div class="post-object__content / media__body">
						<h3>Open contracting awakens: Will the light side in government contracting win?</h3>
						<p>By Georg Neumann <span>C 1</span></p>
					</div>

				</article>

			</section>

		</div> <!-- homepage-blogs -->

		<div class="homepage-spotlight / l-4">

			<section>

				<h3 class="border-top">Spotlight</h3>

				<article class="post-object post-object--vertical">

					<div class="post-object__media">
						<img src="http://placehold.it/459x235" alt="">
						<span class="post-object__tag">Projects</span>
					</div>

					<div class="post-object__content">
						<h3>Help us define our openness</h3>
						<p>Open is part of our name and game at the Open Contracting Partnership. This means, open is at the core of our institution. It is our mission. It is one of our core values. If we want public procurement to be open, we have to be open ourselves. We are trying to model what we ask others to do.</p>
					</div>

				</article>

			</section>

		</div> <!-- homepage-spotlight -->

		<div class="homepage-implement / l-3">

			<section>

				<h3 class="border-top">Implement Open Contracting</h3>

				<span>Learn how to implement open contracting or use contracting data.</span>

				<ul class="cta-list">
					<li><a href="#">Showcases and evidence</a></li>
					<li><a href="#">How to get started</a></li>
					<li><a href="#">Global guidelines</a></li>
				</ul>

			</section>

		</div> <!-- homepage-implement -->

		<section class="g-break">

			<a href="" class="homepage-filter">Filter Blogs &amp; Updates</a>

			<div class="l-4 g-first"></div>
			<div class="l-4"></div>
			<div class="l-4 g-last"></div>
			<div class="l-4 g-first"></div>
			<div class="l-4"></div>
			<div class="l-4 g-last"></div>

		</section>

		<section class="homepage-">

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

	</div> <!-- wrapper -->

<?php get_footer(); ?>
