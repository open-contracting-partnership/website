import Vue from 'vue'

const _cloneDeep = require('lodash.clonedeep');
const _filter = require('lodash.filter');

new Vue({

	el: '#blog-posts',

	data: {
		posts: content.posts,
		filter: "",
		limit: 12
	},

	computed: {

		visiblePosts() {

			let posts = _cloneDeep(this.posts);

			if ( this.filter !== "" ) {

				// the filter is a string but the data is numerical, make them the same
				const filter = parseInt(this.filter);

				posts = _filter(posts, post => {
					return post.issue.length > 0 && post.issue.indexOf(filter) !== -1;
				});

			}

			return posts;

		},

		pagedPosts: function() {
			return this.visiblePosts.slice(0, this.limit);
		},

		hasNextPage: function() {
			return this.visiblePosts.length > this.limit;
		}

	},

	methods: {

		increaseLimit() {

			if ( this.limit < this.posts.length ) {
				this.limit += 12;
			}

		}

	}

});
