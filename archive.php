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

			<?php if ( is_category() ) : ?>
				<span class="archive-content__sub-title"><?php pll_e('Results for Category /'); ?></span>
				<h1><?php single_cat_title(); ?></h1>
			<?php elseif( is_tag() ) : ?>
				<span class="archive-content__sub-title"><?php pll_e('Results for Tag /'); ?></span>
				<h1><?php single_tag_title(); ?></h1>
			<?php elseif( is_tax() ) : ?>
				<span class="archive-content__sub-title"><?php pll_e('Results for Taxonomy /'); ?></span>
				<h1><?php single_cat_title(); ?></h1>
			<?php elseif (is_author()) : ?>
				<?php $author = get_userdata( get_query_var('author') ); ?>
				<span class="archive-content__sub-title"><?php pll_e('Results for Author /'); ?></span>
				<h1><?php echo $author->display_name;?></h1>
			<?php else : ?>
				<span class="archive-content__sub-title"><?php pll_e('Results for Post /'); ?></span>
				<h1><?php the_post_type_label(NULL, TRUE); ?></h1>
			<?php endif;?>

			<div class="archive-content__posts">

				<?php if ( have_posts() ) : while(have_posts()) : the_post(); ?>
					<?php get_partial('post-object', 'horizontal-archive'); ?>
				<?php endwhile; endif; ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
