<?php // home.php ?>

<?php get_header(); ?>

	<div class="wrapper / blog__container">

		<?php $exclude_ids = []; ?>

		<div class="blog__featured / band">

			<?php

				$featured_blog = new query_loop([
					'post_type' => 'post',
					'posts_per_page' => 1,
					'meta_query' => array(
						array(
							'key' => 'featured',
							'value' => TRUE
						)
					)
				]);

			?>

			<?php foreach ( $featured_blog as $featured_blog ) : ?>

				<?php $exclude_ids[] = get_the_ID(); ?>

				<?php get_partial('post-object', 'featured'); ?>

			<?php endforeach; ?>

		</div>

		<div class="blog__recent-news">

			<h4 class="border-top border-top--dark border-top--clean">Recent News</h4>

			<div class="blog__recent-news-items / cf">

				<?php

					$recent_posts = new query_loop([
						'post_type' => 'post',
						'posts_per_page' => 2,
						'post__not_in' => $exclude_ids
					]);

				?>

				<?php foreach ( $recent_posts as $recent_post ) : ?>

					<?php $exclude_ids[] = get_the_ID(); ?>

					<?php get_partial('post-object', 'basic'); ?>

				<?php endforeach; ?>

			</div>

		</div>

		<div class="blog__event-desktop">

			<h4 class="border-top border-top--blue border-top--clean">Upcoming Events</h4>

			<?php get_partial('post-object', 'event'); ?>

			<a class="view-more" href="#">View all events</a>

		</div>

		<div class="blog__popular-tags / band--extra-thick">

			<?php

				$popular_tags = get_terms('post_tag', [
					'orderby' => 'count',
					'number' => 40
				]);

			?>

			<?php if ( $popular_tags ) : ?>

				<section>

					<h4 class="border-top border-top--dark border-top--clean">Popular Tags</h4>

					<ul class="button__list">

						<?php foreach ( $popular_tags as $popular_tag ) : ?>
							<li><a href="<?php echo get_term_link($popular_tag); ?>" class="button button--uppercase button--tag"><?php echo $popular_tag->name; ?></a></li>
						<?php endforeach; ?>

					</ul>

				</section>

			<?php endif; ?>

		</div>

		<section class="blog__posts / band band--thick">

			<div class="posts-filter / band">

				<div class="posts-filter__inner">

					<a href="#" class="posts-filter__button"><svg><use xlink:href="#icon-menu" /></svg><?php pll_e('Filter Blogs & Updates'); ?></a>

					<form action="#" class="posts-filter__form / custom-checkbox">
						<label><input type="checkbox" name="name" value="" checked><span><svg><use xlink:href="#icon-close"></svg></span>Menu Item</label>
						<label><input type="checkbox" name="name" value=""><span><svg><use xlink:href="#icon-close"></svg></span>Menu Item</label>
						<label><input type="checkbox" name="name" value=""><span><svg><use xlink:href="#icon-close"></svg></span>Menu Item</label>
					</form>

				</div>

			</div>

			<div class="blog__post-items">

				<?php

					$recent_posts = new query_loop([
						'post_type' => 'post',
						'posts_per_page' => 12,
						'post__not_in' => $exclude_ids
					]);

				?>

				<?php foreach ( $recent_posts as $recent_post ) : ?>

					<?php $exclude_ids[] = get_the_ID(); ?>

					<?php get_partial('post-object', 'vertical'); ?>

				<?php endforeach; ?>

			</div> <!-- / .blog__post-items -->

		</section>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
