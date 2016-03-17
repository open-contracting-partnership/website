<?php // archive.php ?>

<?php get_header(); ?>

	<div id="archive-posts" class="wrapper archive--padding">

		<?php

			global $wp_query;

			// get a feed of blog posts, this will include news post types,
			// as well as invluding taxonomies to filter on, e.g. issue

			$posts = vue_posts([
				'query' => array_merge($wp_query->query_vars, [
					'post_type' => ['post', 'news', 'event', 'resource', 'success-story', 'policy', 'newsletter', 'media-clipping']
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

		?>

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

				<div v-for="post in posts" class="post-object post-object--archive post-object--type-{{ post.post_type }}">
					<post :post="post"></post>
				</div>

			</div>

			<div class="archive-filtering">

				<?php if ( is_tag() ) : ?>

					<div class="archive__sidebar archive__sidebar-tags / archive-filtering__sort / band band--thick">

						<h4><?php pll_e('Similar tags'); ?></h4>

						<input v-model="term_search" type="search" placeholder="Search tags">

						<ul class="nav nav--vertical / nav--in-page" data-nav-active="false">
							<li v-for="term in visibleTerms"><a href="/tag/{{term.slug}}/">{{term.name}} ({{term.count}})</a></li>
						</ul>

					</div>

				<?php endif; ?>

				<!-- <div class="archive__sidebar archive__sidebar-type / archive-filtering__sort / band band--thick">

					<h4><?php pll_e('Sort by category'); ?></h4>

					<ul class="nav nav--vertical / nav--in-page" data-nav-active="false">
						<li><a href="#"><?php pll_e('All'); ?></a></li>
					</ul>

				</div> -->

			</div>

		</div>

	</div>

	<script src="https://cdn.jsdelivr.net/vue/latest/vue.js"></script>

	<template id="post-template">

		<div class="post-object__media">
			<svg><use xlink:href="#icon-{{post.post_type}}"></use></svg>
		</div>

		<div class="post-object__content">

			<div>
				<span class="post-object__tag post-object__tag--{{post.post_type}}">{{post.custom.post_type_label}}</span>
				<a href="{{post.link}}"><h4>{{{post.title}}}</h4></a>
			</div>

			<div class="post-object__meta">
				<span>{{{post.custom.authors}}}</span>
				<time>{{post.date}}</time>
			</div>

		</div>

	</template>

	<script>

		// register the grid component
		Vue.component('post', {
			template: '#post-template',
			props: {
				post: Object
			}
		});

		// bootstrap the demo
		var posts = new Vue({

			el: '#archive-posts',

			data: {
				// data
				posts: <?php echo json_encode($posts); ?>,
				terms: <?php echo json_encode($terms); ?>,
				// filters
				filter_issue: [],
				term_search: ''
			},

			watch: {

				filter_issue: function() {
					this.filter();
				},

				term_search: function() {
					this.filterTerms();
				}

			},

			computed: {

				visibleTerms: function() {

					var terms = [];

					this.terms.forEach(function(term) {

						if ( term.display === true ) {
							terms.push(term);
						}

					});

					if ( ! this.term_search ) {
						terms = terms.slice(0, 10);
					}

					return terms;

				}

			},

			methods: {

				increaseLimit: function() {

					if ( this.limit < this.posts.length ) {
						this.limit += 12;
					}

				},

				filter: function() {

					// reset all resources

					this.posts.forEach(function(post, index) {
						post.display = true;
					});

					// apply issue filter

					if ( this.filter_issue.length ) {

						this.posts.forEach(function(post, index) {

							if ( intersection(Object.keys(post.taxonomies['issue']), this.filter_issue).length === 0 ) {
								post.display = false;
							}

						}.bind(this));

					}


				},

				filterTerms: function() {

					// reset all resources

					this.terms.forEach(function(term, index) {
						term.display = true;
					});

					// apply issue filter

					if ( this.term_search.length ) {

						this.terms.forEach(function(term, index) {
							term.display = !! ~ term.name.toLowerCase().indexOf(this.term_search.toLowerCase());
						}.bind(this));

					}

				}

			}

		});

	</script>

<?php get_footer(); ?>
