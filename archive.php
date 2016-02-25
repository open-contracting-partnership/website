<?php // archive.php ?>

<?php get_header(); ?>

	<div class="wrapper page--padding">

		<div class="archive-filtering">

			<form class="archive-filtering__search" action="index.html" method="post">
				<input type="search" placeholder="Search tags">
				<button type="button" name="button"><svg><use xlink:href="#icon-search"></svg></button>
			</form>

			<div class="archive-filtering__sort">

				<h4>Sort by category</h4>

				<ul class="nav nav--vertical nav--in-page">
					<li><a href="#">All</a></li>
				</ul>

			</div>

		</div>

		<div class="archive-content">

			<span class="archive-content__sub-title">Results for Tag /</span>

			<h1><?php single_tag_title(); ?></h1>

			<div class="archive-content__posts">

				<?php if ( have_posts() ) : while(have_posts()) : the_post(); ?>
					<?php get_partial('post-object', 'horizontal-archive'); ?>
				<?php endwhile; endif; ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
