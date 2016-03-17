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
				'taxonomies' => ['issue'],
				'custom' => array(
					'authors' => function() {
						return get_authors(FALSE);
					},
					'post_type_label' => function() {
						return get_post_type_label();
					}
				)
			]);

		?>

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

				<div v-for="post in posts" class="post-object post-object--archive post-object--type-{{ post.post_type }}">
					<post :post="post"></post>
				</div>

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
				<span>{{post.custom.authors}}</span>
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
				// filters
				filter_issue: []
			},

			watch: {

				filter_issue: function() {
					this.filter();
				}

			},

			// computed: {
			//
			// 	// visiblePosts: function() {
			// 	//
			// 	// 	var posts = [];
			// 	//
			// 	// 	this.posts.forEach(function(post) {
			// 	//
			// 	// 		if ( post.display === true ) {
			// 	// 			posts.push(post);
			// 	// 		}
			// 	//
			// 	// 	});
			// 	//
			// 	// 	return posts.slice(0, this.limit);
			// 	// }
			//
			// },

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

				hasTerms: function(taxonomy) {
					return Object.keys(taxonomy).length > 0;
				}

			}

		});

		var intersection = function (a, b) {

			var ai=0, bi=0;
			var result = new Array();

			while( ai < a.length && bi < b.length ) {

				if      (a[ai] < b[bi] ){ ai++; }
				else if (a[ai] > b[bi] ){ bi++; }
				else {
					result.push(a[ai]);
					ai++;
					bi++;
				}

			}

			return result;

		}

	</script>

<?php get_footer(); ?>
