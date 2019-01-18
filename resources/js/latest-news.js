import Vue from 'vue'

new Vue({

	el: '#blog-posts',

	data: {
		// data
		posts: content.posts,
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
				return content.select_a_filter;
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

	mounted() {
		
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

		// add document click event to close filter
		document.addEventListener('click', function() {
			this.filter.open = false;
		}.bind(this));

	}

});
