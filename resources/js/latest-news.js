import Vue from 'vue'
import PrimaryCard from './cards/Primary.vue';

import { map } from 'lodash';

const _cloneDeep = require('lodash.clonedeep');
const _filter = require('lodash.filter');
const _intersection = require('lodash.intersection');

Vue.component('primary-card', PrimaryCard);

new Vue({
    el: '#blog-posts',

    data: {
        posts: latest_news_content.posts,
        filters: {
            available: latest_news_content.filters,
            selected: [],
        },
        limit: 12,
    },

    watch: {
        'filters.selected': function () {
            this.setFiltersUrl();
        }
    },

    computed: {
        visiblePosts() {
            let posts = _cloneDeep(this.posts);

            if (this.filters.selected.length) {
                posts = _filter(posts, post => {
                    return _intersection(post.issues, this.filters.selected).length > 0;
                });
            }

            return posts;
        },

        pagedPosts: function() {
            return this.visiblePosts.slice(0, this.limit);
        },

        hasNextPage: function() {
            return this.visiblePosts.length > this.limit;
        },

        availableFilterSlugs() {
            return map(this.filters.available, 'slug');
        },

        selectedFiltersString() {
            return this.filters.selected.join('+');
        }
    },

    methods: {
        increaseLimit() {
            if (this.limit < this.posts.length) {
                this.limit += 12;
            }
        },

        reset() {
            this.filters.selected = [];
        },

        setFiltersUrl() {
            window.location.hash = this.selectedFiltersString;
        },

        setFiltersFromUrl() {
            if (window.location.hash) {
                // we only want to set a filter if it's in the available list
                const filters = window.location.hash.replace('#', '')
                    .split('+')
                    .filter(filter => {
                        return this.availableFilterSlugs.includes(filter);
                    })

                this.filters.selected = filters;

                // update the filters url, just in case it originally included
                // any invalid filters, we want to clean those out
                this.setFiltersUrl();
            }
        }
    },

    mounted() {
        this.setFiltersFromUrl();
    }
});
