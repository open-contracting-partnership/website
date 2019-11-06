import Vue from 'vue'

const _cloneDeep = require('lodash.clonedeep');
const _filter = require('lodash.filter');

import PrimaryCard from './components/cards/primary.vue';

new Vue({

	el: '#blog-posts',

	components: {
		'primary-card': PrimaryCard
	},

	data: {
		posts: content.posts,
		filter: "",
		limit: 12
	},

	computed: {

		visiblePosts() {

			let posts = _cloneDeep(this.posts);

			if ( this.filter !== "" ) {

				posts = _filter(posts, post => {
					return typeof post.issue !== 'undefined' && post.issue.indexOf(this.filter) === -1;
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
