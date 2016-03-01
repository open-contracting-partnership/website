<?php // archive.php ?>

<?php get_header(); ?>

	<div class="wrapper archive--padding">

		<!-- <div class="archive-filtering">

			<form class="archive-filtering__search" action="index.html" method="post">
				<input type="search" placeholder="Search tags">
				<button type="button" name="button"><svg><use xlink:href="#icon-search"></svg></button>
			</form>

			<div class="archive-filtering__sort">

				<h4><?php pll_e('Sort by category'); ?></h4>

				<ul class="nav nav--vertical nav--in-page">
					<li><a href="#"><?php pll_e('All'); ?></a></li>
				</ul>

			</div>

		</div> -->

		<div class="archive-content">

			<h1><?php the_post_type_label(NULL, TRUE); ?></h1>

			<p class="strapline strapline--blue">Our  multi-stakeholder advisory board is made up of renowned individuals from across government, the private sector, civil society, the technology sector and development organisations. It meets twice a year and on a regular basis in its subcommittees.</p>

			<div class="archive-content__posts">

				<?php if ( have_posts() ) : while(have_posts()) : the_post(); ?>
					<?php get_partial('post-object', 'event'); ?>
				<?php endwhile; endif; ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
