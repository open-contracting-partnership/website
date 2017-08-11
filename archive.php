<?php // archive.php ?>

<?php get_header(); ?>

	<div id="archive-posts" class="page__wrapper">

		<?php

			global $wp_query;

			// get a feed of blog posts, this will include news post types,
			// as well as invluding taxonomies to filter on, e.g. issue

			$posts = vue_posts([
				'query' => array_merge($wp_query->query_vars, [
					'post_type' => ['post', 'news', 'event', 'resource']
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
								<a class="card__link" href="{{ post.link }}">{{{ post.title }}}</a>
							</h6>

						</div>

						<p class="card__meta card__meta--alt">
							<span class="card__type" data-content-type="{{ post.post_type }}">{{ post.custom.post_type_label }}</span>
							<time class="card__date">{{ post.date }}</time>
							<span class="card__author" v-if="post.custom.authors !== ''">By {{{ post.custom.authors }}}</span>
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
							<li v-for="term in visibleTerms"><a href="/tag/{{term.slug}}/">{{term.name}} ({{term.count}})</a></li>
						</ul>

					</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

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
