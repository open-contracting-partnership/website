import Vue from 'vue'

const _cloneDeep = require('lodash.clonedeep');
const _filter = require('lodash.filter');
const _intersection = require('lodash.intersection');

new Vue({
    el: '#blog-posts',

    data: {
        posts: content.posts,
        filters: [],
        limit: 12
    },

    computed: {
        visiblePosts() {
            let posts = _cloneDeep(this.posts);

            if (this.filters.length) {
                posts = _filter(posts, post => {
                    return _intersection(post.issues, this.filters).length > 0;
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
            if (this.limit < this.posts.length) {
                this.limit += 12;
            }
        }
    }
});
