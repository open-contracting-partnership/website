<?php // home.php ?>

<?php get_header(); ?>

	<div id="blog-posts" class="wrapper / blog__container">

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

				$exclude_ids += $featured_blog->post_ids;

			?>

			<?php foreach ( $featured_blog as $featured_blog ) : ?>
				<?php get_partial('post-object', 'featured'); ?>
			<?php endforeach; ?>

		</div>

		<div class="blog__subscribe">

			<h4 class="border-top border-top--clean">Subscribe to our newsletter</h4>

			<form class="flex-field" action="index.html" method="post">
				<input type="email" placeholder="Enter your email">
				<button>Send</button>
			</form>

			<p class="blog__subscribe-follow">Alternatively, follow us on <a href="#">Facebook</a>, <a href="#">Twitter</a>, &amp; <a href="#">Linkedin</a></p>

		</div>

		<div class="blog__recent-news / band--thick">

			<h4 class="border-top border-top--clean">Recent News</h4>

			<div class="blog__recent-news-items / cf">

				<?php

					$recent_posts = new query_loop([
						'post_type' => 'post',
						'posts_per_page' => 2,
						'post__not_in' => $exclude_ids
					]);

					$exclude_ids += $recent_posts->post_ids;

				?>

				<?php foreach ( $recent_posts as $recent_post ) : ?>
					<?php get_partial('post-object', 'basic'); ?>
				<?php endforeach; ?>

			</div>

		</div>

		<div class="blog__event / band--thick">

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

					<h4 class="border-top border-top--clean">Popular Tags</h4>

					<ul class="button__list">

						<?php foreach ( $popular_tags as $popular_tag ) : ?>
							<li><a href="<?php echo get_term_link($popular_tag); ?>" class="button button--uppercase button--tag button--small"><?php echo $popular_tag->name; ?></a></li>
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

						<label v-for="issue in issue_terms">
							<input type="checkbox" name="name" value="{{ issue.slug }}" v-model="filter_resource_type" />
							<span><svg><use xlink:href="#icon-close"></svg></span>
							{{ issue.name }}
						</label>

					</form>

				</div>

			</div>

			<?php

				// get a feed of blog posts, this will include news post types,
				// as well as invluding taxonomies to filter on, e.g. issue

				$blog_posts = vue_posts([
					'query' => array(
						'post_type' => ['post', 'news'],
						'posts_per_page' => -1
					),
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

				$issue_terms = array_values(get_terms('issue'));

			?>

			<div class="blog__post-items">

				<a v-for="post in visiblePosts" class="post-object post-object--vertical" href="{{ post.link }}">
					<post :post="post"></post>
				</a>

			</div> <!-- / .blog__post-items -->

		</section>

	</div> <!-- / .wrapper -->

	<script src="https://cdn.jsdelivr.net/vue/latest/vue.js"></script>

	<template id="post-template">

		<div class="post-object__media">

			<img v-if="! hasThumbnail()" src="http://placehold.it/460x230" alt="">
			<div v-else>
				{{{ post.custom.thumbnail }}}
			</div>

			<span class="post-object__tag post-object__tag--light">{{ post.custom.post_type }}</span>

		</div>

		<div class="post-object__content">
			<p class="post-object__meta">{{ post.custom.authors }}&nbsp;&nbsp;{{ post.date }}</p>
			<h4><?php the_title(); ?></h4>
		</div>

	</template>

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
				filter_issue: [],
				// limits
				limit: 12
			},

			watch: {

				'filter_issue':  function() {
					this.filter();
				}

			},

			computed: {

				visiblePosts: function() {
					return this.posts.slice(0, this.limit);
				}

			},

			methods: {

				filter: function() {

					// reset all resources

					this.resources.forEach(function(resource, index) {
						resource.display = true;
					});

					// apply search

					if ( this.search !== "" ) {

						var re = new RegExp(this.search, "gi");

						this.resources.forEach(function(resource, index) {

							if ( resource.title.match(re) === null ) {
								resource.display = false;
							}

						});

					}

					// apply resource type filter

					if ( this.filter_resource_type.length ) {

						this.resources.forEach(function(resource, index) {

							if ( ! intersection(Object.keys(resource.taxonomies['resource-type']), this.filter_resource_type) ) {
								resource.display = false;
							}

						}.bind(this));

					}


				},

				reset: function() {
					this.search = "";
					this.filter_issue = [];
				},

				hasTerms: function(taxonomy) {
					return Object.keys(taxonomy).length > 0;
				}

			}

		});

		var intersection = function (haystack, arr) {
			return arr.some(function (v) {
				return haystack.indexOf(v) >= 0;
			});
		};

	</script>


<?php get_footer(); ?>
