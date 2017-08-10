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

					$options = array(
						'crop' => 'faces',
						'fit' => 'crop',
						'w' => 460,
						'h' => 460 / (21 / 9),
						'fm' => 'pjpg'
					);

					if ( has_post_thumbnail() ) {

						return imgix::source('featured')
							->options($options)
							->url();

					} else {

						return imgix::source('url', get_bloginfo('template_directory') . '/assets/img/fallback.jpg')
							->options($options)
							->url();

					}

				}
			)
		]);

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

		// featured news
		$featured_news = new query_loop([
			'post_type' => 'news',
			'posts_per_page' => 1
		]);

		// recent news
		$recent_news = new query_loop([
			'post_type' => 'news',
			'posts_per_page' => 6
		]);

		// featured events
		$featured_events = new query_loop([
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

		// upcoming events
		$upcoming_events = new query_loop([
			'post_type' => 'event',
			'posts_per_page' => 4,
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

			<div class="blog__featured-news">

				<?php if ( load_post($featured_news->query->posts) ) : ?>
					<?php get_partial('card', 'stripped', ['type_label' => __('Featured News', 'ocp')]); ?>
				<?php endif; ?>

				<a class="view-more" href="<?php echo get_post_type_archive_link('news'); ?>"><?php _e('View all news', 'ocp'); ?></a>

			</div>

			<div class="blog__featured-event">

				<?php if ( load_post($featured_events->query->posts) ) : ?>
					<?php get_partial('card', 'stripped', ['type_label' => __('Featured Event', 'ocp')]); ?>
				<?php endif; ?>

				<a class="view-more" href="<?php echo get_post_type_archive_link('event'); ?>"><?php _e('View all events', 'ocp'); ?></a>

			</div>

		</div>

		<div class="blog-filter">

			<span><?php _e("I'd like to see more blogs about <strong>Open Contracting</strong> and ", 'ocp'); ?></span>

			<span class="blog-filter__options">

				<span class="blog-filter__label" v-on:click.stop="filter.open = ! filter.open">{{{ filterTitle }}}</span>

				<svg><use xlink:href="#icon-arrow-down" v-bind="{ 'xlink:href': '#icon-arrow-down' }"></svg>

				<ul class="blog-filter__list / nav" v-show="filter.open === true">
					<li><a href="#" v-on:click.prevent.stop="resetFilter()"><?php _e('Everything', 'ocp'); ?></a></li>
					<li v-for="tag in filter.options"><a href="#" v-on:click.prevent.stop="setFilter(tag)">{{ tag.title }}</a></li>
				</ul>

			</span>

		</div>

		<section class="blog__posts / band band--thick">

			<div class="blog__post-items">

				<div v-for="post in pagedPosts" class="card card--primary">

					<div class="card__header">
						<img class="card__featured-media" v-bind:src="post.custom.thumbnail" />
					</div>

					<div class="card__content">

						<div class="card__title">

							<h6 class="card__heading">
								<a class="card__link" href="{{ post.link }}">{{{ post.title }}}</a>
							</h6>

						</div>

						<p class="card__meta">
							<time class="card__date">{{ post.date }}</time>
							<span class="card__author" v-if="post.custom.authors"><?php _e('By', 'ocp'); ?> {{{ post.custom.authors }}}</span>
						</p>

					</div>

				</div>

			</div> <!-- / .blog__post-items -->

			<p class="blog__load-more">
				<a href="#" class="button" v-on:click.prevent="increaseLimit()" v-if="hasNextPage"><?php _e('Load more', 'ocp'); ?></a>
			</p>

		</section>

		<?php get_partial('update', 'panel'); ?>

		<div class="blog__news">

			<div class="content-title">
			    <span class="card__type" data-content-type="news"><?php the_post_type_label('news', TRUE); ?></span>
			    <a class="content-title__link" href="<?php echo get_post_type_archive_link('news'); ?>"><?php _e('View all news', 'ocp'); ?></a>
			</div>

			<div class="blog__news-inner">

				<?php foreach ( $recent_news as $news ) : ?>
					<?php get_partial('card', 'stripped', ['type_label' => FALSE]); ?>
				<?php endforeach; ?>

			</div>

		</div>

		<div class="blog__events">

			<div class="content-title">
			    <span class="card__type" data-content-type="event"><?php the_post_type_label('event', TRUE); ?></span>
			    <a class="content-title__link" href="<?php echo get_post_type_archive_link('event'); ?>"><?php _e('View all events', 'ocp'); ?></a>
			</div>

			<div class="blog__events-inner">

				<?php foreach ( $upcoming_events as $event ) : ?>
					<?php get_partial('card', 'event'); ?>
				<?php endforeach; ?>

			</div>

		</div>

	</div> <!-- / .wrapper -->

	<script>

		$(document).ready(function() {

			$('body').on('click', function() {
				posts.filter.open = false;
			});

		});

	</script>

	<script>

		var select_a_filter = '<?php _e('select a filter', 'ocp'); ?>'.split(' ').join('&nbsp;');

		// bootstrap the demo
		var posts = new Vue({

			el: '#blog-posts',

			data: {
				// data
				posts: <?php echo json_encode($blog_posts); ?>,
				// filters
				filter: {
					open: false,
					selected: null,
					options: {},
				},
				// limits
				limit: 12
			},

			watch: {

				filterSlug: function() {
					this.filterPosts();
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

					return posts;
				},

				pagedPosts: function() {
					return this.visiblePosts.slice(0, this.limit);
				},

				hasNextPage: function() {
					return this.visiblePosts.length > this.limit;
				},

				filterSlug: function() {
					return this.filter.selected !== null ? this.filter.selected.slug : null;
				},

				filterTitle: function() {

 					if ( ! this.filter.selected ) {
						return select_a_filter;
					} else {
						return this.filter.selected.title.replace(new RegExp(' ', 'g'), '&nbsp;');
					}

				}

			},

			methods: {

				increaseLimit: function() {

					if ( this.limit < this.posts.length ) {
						this.limit += 12;
					}

				},

				filterPosts: function() {

					// reset all resources

					this.posts.forEach(function(post, index) {
						post.display = true;
					});

					// apply issue filter

					if ( this.filter.selected !== null ) {

						this.posts.forEach(function(post, index) {

							if ( Object.keys(post.taxonomies['issue']).indexOf(this.filter.selected.slug) === -1 ) {
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
				}

			},

			ready: function() {

				var filter_options = {};

				this.posts.forEach(function(post, index) {

					if ( Object.keys(post.taxonomies['issue']).length ) {

						for ( var key in post.taxonomies['issue'] ) {

							if ( typeof filter_options[key] === 'undefined' ) {

								filter_options[key] = {
									slug: key,
									title: post.taxonomies['issue'][key],
									count: 1
								};

							} else {
								filter_options[key].count++;
							}

						}

					}

				}.bind(this));

				// triggers two way data binding within vue
				this.filter.options = filter_options;

			}

		});

	</script>

<?php get_footer(); ?>
