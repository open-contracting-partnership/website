import Vue from 'vue'

const _cloneDeep = require('lodash.clonedeep');
const _filter = require('lodash.filter');

new Vue({

	el: '#blog-posts',

	data: {
		posts: content.posts,
		filter: null,
		limit: 12
	},

	computed: {

		visiblePosts() {

			let posts = _cloneDeep(this.posts);

			if ( this.filter !== null ) {

				posts = _filter(posts, post => {
					return post.issue.indexOf(this.filter) === -1;
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
