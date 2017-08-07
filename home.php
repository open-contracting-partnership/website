<?php // home.php ?>

<?php get_header(); ?>

	<?php

		// get a feed of blog posts, this will include news post types,
		// as well as invluding taxonomies to filter on, e.g. issue

		$blog_posts = vue_posts([
			'query' => array(
				'post_type' => ['post', 'news'],
				'posts_per_page' => -1
			),
			'ignore' => ['content', 'excerpt', 'slug'],
			'taxonomies' => ['issue'],
			'custom' => array(
				'authors' => function() {
					return get_authors();
				},
				'post_type' => function() {
					return get_post_type_label();
				},
				'thumbnail' => function() {

					$image = get_the_post_thumbnail(NULL, '2x1_460');

					if ( trim($image) === '' ) {
						$image = FALSE;
					}

					return $image;

				}
			)
		]);

		$issue_terms = array_values(get_terms('issue', [
			'post_type' => ['post', 'news'],
			'fields' => 'all'
		]));

		$popular_tags = get_terms('post_tag', [
			'orderby' => 'count',
			'order' => 'DESC',
			'number' => 40
		]);

		$exclude_ids = [];

		// feature blog
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

		$exclude_ids += $featured_blog->post_ids;

		// recent news
		$recent_news = new query_loop([
			'post_type' => 'news',
			'posts_per_page' => 1
		]);

		// recent events
		$upcoming_events = new query_loop([
			'post_type' => 'event',
			'posts_per_page' => 1,
			'orderby'    => 'meta_value_num',
			'order'      => 'ASC',
			'meta_key' => ' event_date',
			'meta_query' => array(
				array(
					'key' => 'event_date',
					'value' => date('Ymd'),
					'compare' => '>='
				),
			)
		]);

	?>

	<div id="blog-posts" class="wrapper / blog__container">

		<div class="blog__header">

			<div class="blog__featured">

				<?php if ( load_post($featured_blog->query->posts) ) : ?>
					<?php get_partial('card', 'featured', ['type_label' => 'Featured Blog']); ?>
				<?php endif; ?>

			</div>

			<div class="blog__news">

				<?php if ( load_post($recent_news->query->posts) ) : ?>
					<?php get_partial('card', 'stripped', ['type_label' => 'Featured News']); ?>
				<?php endif; ?>

				<a class="view-more" href="/news"><?php _e('View all news', 'ocp'); ?></a>

			</div>

			<div class="blog__event">

				<?php if ( load_post($upcoming_events->query->posts) ) : ?>
					<?php get_partial('card', 'stripped', ['type_label' => 'Featured Event']); ?>
				<?php endif; ?>

				<a class="view-more" href="/events"><?php _e('View all events', 'ocp'); ?></a>

			</div>

		</div>

		<div class="blog-filter">

			<span>I'd like to see more blogs about <strong>Open Contracting</strong> and </span>

			<span class="blog-filter__options">

				<span class="blog-filter__label" v-on:click.stop="filter.open = ! filter.open">{{{ filterTitle }}}</span>

				<svg><use xlink:href="#icon-arrow-down"></svg>

				<ul class="blog-filter__list / nav" v-show="filter.open === true">
					<li><a href="#" v-on:click.prevent.stop="resetFilter()">Everything</a></li>
					<li v-for="tag in filter.options"><a href="#" v-on:click.prevent.stop="setFilter(tag)">{{ tag.name }}</a></li>
				</ul>

			</span>

		</div>

		<section class="blog__posts / band band--thick">

			<div class="posts-filter / band">

				<div class="posts-filter__inner">

					<a href="#" class="posts-filter__button"><svg><use xlink:href="#icon-filter" /></svg><?php _e('Filter Blogs & Updates', 'ocp'); ?></a>

					<form action="#" class="posts-filter__form / custom-checkbox">

						<label v-for="issue in issue_terms">

							<input type="checkbox" value="{{ issue.slug }}" v-model="filter_issue" />

							<span class="custom-checkbox__box">
								<svg><use xlink:href="#icon-close"></svg>
							</span>

							{{ issue.name }}

						</label>

					</form>

				</div>

			</div>

			<div class="blog__post-items">

				<a v-for="post in visiblePosts" class="post-object post-object--vertical" href="{{ post.link }}">
					<post :post="post"></post>
				</a>

			</div> <!-- / .blog__post-items -->

		</section>

	</div> <!-- / .wrapper -->

	<template id="post-template">

		<div class="post-object__media">

			<div class="post-object__media-wrapper">

				<div class="content">

					<img v-if="! hasThumbnail()" src="<?php bloginfo('template_directory'); ?>/assets/img/fallback.jpg" alt="">
					<div v-else>
						{{{ post.custom.thumbnail }}}
					</div>

				</div>

			</div>

			<!-- TODO: re-implement after redesign -->
			<!-- <span class="post-object__tag-overlay post-object__tag--light">{{ post.custom.post_type }}</span> -->

		</div>

		<div class="post-object__content">
			<p class="post-object__meta">{{{ post.custom.authors }}}&nbsp;&nbsp;{{ post.date }}</p>
			<h4>{{{ post.title }}}</h4>
		</div>

	</template>

	<script>

		$(document).ready(function() {

			var $window = $(window),
				$main = $('main');

			$(window).on('scroll', $.throttle(500, function() {

				if ( ($window.scrollTop() + $window.height()) > ($main.position().top + $main.height()) - 500 ) {
					posts.increaseLimit();
				}

			}));

			$('body').on('click', function() {
				posts.filter.open = false;
			});

		});

	</script>

	<script>

		// register the grid component
		Vue.component('post', {
			template: '#post-template',
			props: {
				post: Object
			},
			methods: {

				hasThumbnail: function() {
					return !! this.post.custom.thumbnail;
				}

			}

		});

		// bootstrap the demo
		var posts = new Vue({

			el: '#blog-posts',

			data: {
				// data
				posts: <?php echo json_encode($blog_posts); ?>,
				issue_terms: <?php echo json_encode($issue_terms); ?>,
				// filters
				filter: {
					open: false,
					selected: '',
					options: <?php echo json_encode($popular_tags); ?>,
				},
				// limits
				limit: 12
			},

			watch: {

				filter_issue: function() {
					this.filter();
				}

			},

			computed: {

				visiblePosts: function() {

					var posts = [];

					this.posts.forEach(function(post) {

						if ( post.display === true ) {
							posts.push(post);
						}

					});

					return posts.slice(0, this.limit);
				},

				filterTitle: function() {

 					if ( ! this.filter.selected ) {
						return 'select&nbsp;a&nbsp;filter';
					} else {
						return this.filter.selected.name.replace(new RegExp(' ', 'g'), '&nbsp;');
					}

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

				setFilter: function(filter) {
					this.filter.selected = filter;
					this.filter.open = false;
				},

				resetFilter: function() {
					this.filter.selected = null;
					this.filter.open = false;
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
