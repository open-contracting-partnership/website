<?php // archive.php ?>

<?php get_header(); ?>

	<div id="archive-posts" class="page__wrapper">

		<?php

			global $wp_query;

			// get a feed of blog posts, this will include news post types,
			// as well as invluding taxonomies to filter on, e.g. issue

			$posts = vue_posts([
				'query' => array_merge($wp_query->query_vars, [
					'post_type' => ['post', 'news', 'event', 'resource'],
					'posts_per_page' => 999
				]),
				'ignore' => ['content', 'excerpt', 'slug'],
				'custom' => array(
					'authors' => function() {
						return get_authors(FALSE);
					},
					'post_type_label' => function() {
						return get_post_type_label();
					}
				)
			]);

			$terms = [];

			if ( is_tag() ) {

				$terms = get_terms('post_tag', [
					'orderby' => 'count',
					'order' => 'DESC'
				]);

				foreach ( $terms as $key => $term ) {
					$terms[$key]->display = TRUE;
				}

			}

			wp_localize_script('archive', 'content', [
				'posts' => $posts,
				'terms' => $terms
			]);

		?>

		<div class="archive-content">

			<?php if ( is_category() ) : ?>
				<h1><?php single_cat_title(); ?></h1>
			<?php elseif( is_tag() ) : ?>
				<h1><?php single_tag_title(); ?></h1>
			<?php elseif( is_tax() ) : ?>
				<h1><?php single_cat_title(); ?></h1>
			<?php elseif (is_author()) : ?>
				<?php $author = get_userdata( get_query_var('author') ); ?>
				<h1><?php echo $author->display_name;?></h1>
			<?php else : ?>
				<h1><?php the_post_type_label(NULL, TRUE); ?></h1>
			<?php endif;?>

			<div class="archive-content__posts">

				<div v-for="post in posts" class="card card--primary">

					<div class="card__content">

						<div class="card__title">

							<h6 class="card__heading">
								<a class="card__link" :href="post.link" v-html="post.title"></a>
							</h6>

						</div>

						<p class="card__meta card__meta--alt">
							<span class="card__type" :data-content-type="post.post_type">{{ post.custom.post_type_label }}</span>
							<time class="card__date">{{ post.date }}</time>
							<span class="card__author" v-if="post.custom.authors !== ''">By <span v-html="post.custom.authors"></span></span>
						</p>

					</div>

				</div>

			</div>

			<div class="archive-filtering">

				<?php if ( is_tag() ) : ?>

					<div class="archive__sidebar archive__sidebar-tags / archive-filtering__sort / band band--thick">

						<h6 class="border-top"><?php _e('Similar tags', 'ocp'); ?></h6>

						<input v-model="term_search" type="search" placeholder="Search tags">

						<ul class="nav nav--vertical nav--list" data-nav-active="false">
							<li v-for="term in visibleTerms"><a :href="'/tag/' + term.slug">{{term.name}} ({{term.count}})</a></li>
						</ul>

					</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
