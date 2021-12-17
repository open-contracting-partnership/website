import _ from 'underscore'
import Vue from 'vue'

const _cloneDeep = require('lodash.clonedeep');
const _filter = require('lodash.filter');

// element components
import Resource from './components/cards/resource.vue'

new Vue({

    el: '#resource-archive',

    components: {
        Resource
    },

    data: {

        // data
        resources: content.resources,

        // switch
        tab: 'resource-library',

        // search and filters
        search: '',
        filter: {}

    },

    watch: {

        filter: {
            deep: true,
            handler() {

                let params = this.filter;

                params.tab = this.tab;

                const url = window.location.pathname + '?' + new URLSearchParams(params).toString();
                history.replaceState(null, '', url);
            }
        }

    },

    computed: {

        visibleResources: function () {

            let resources = _cloneDeep(this.resources);

            resources = _filter(resources, resource => {

                let display = true;

                // apply search

                if (this.search !== "") {

                    var re = new RegExp(this.search, "gi");

                    if (resource.title.match(re) === null) {
                        display = false;
                    }

                }

                if (this.tab === 'resource-library') {

                    if (resource.location.indexOf('resources') === -1) {
                        display = false;
                    }

                } else {

                    if (resource.location.indexOf('learning') === -1) {
                        display = false;
                    }

                }

                // apply resource type filter
                if (this.filter['resource-type']) {

                    if (resource.type !== this.filter['resource-type']) {
                        display = false;
                    }

                }

                // apply learning resource category filter
                if (this.filter['learning-resource-category']) {

                    if (resource.learning_resource_category !== this.filter['learning-resource-category']) {
                        display = false;
                    }

                }

                return display;

            });

            return resources;

        }

    },

    methods: {

        toggleFilter(event) {

            const value = event.target.value;
            const taxonomy = event.target.dataset.taxonomy;

            if (this.filter[taxonomy] === undefined) {
                this.$set(this.filter, taxonomy, value);
            } else if (this.filter[taxonomy] !== value) {
                this.$set(this.filter, taxonomy, value);
            } else {
                this.$delete(this.filter, taxonomy)
            }

        },

        isChecked(taxonomy, slug) {
            return this.filter[taxonomy] === slug;
        },

        switchTab(event) {
            this.tab = event.target.dataset.tab;
            this.resetFilters();
        },

        resetFilters() {
            this.search = '';
            this.filter = {};
        }

    },

    mounted() {

        const query_string = window.location.search.split('?')[1];
        const params = new URLSearchParams(query_string);

        if (params.has('tab')) {

            if (params.get('tab') === 'resource-library') {
                this.tab = 'resource-library';
            } else if (params.get('tab') === 'learning-library') {
                this.tab = 'learning-library';
            }

        }

        if (params.has('learning-resource-category')) {
            this.$set(this.filter, 'learning-resource-category', params.get('learning-resource-category'));
        }

        if (params.has('resource-type')) {
            this.$set(this.filter, 'resource-type', params.get('resource-type'));
        }

    }

});
