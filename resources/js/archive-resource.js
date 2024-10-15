import _ from 'lodash'
import Vue from 'vue'

const _cloneDeep = require('lodash.clonedeep');

new Vue({
    el: '#resource-archive',

    data: {
        // data
        resources: content.resources,

        // search and filters
        search: '',
        filters: []
    },

    // watch: {

    //     filter: {
    //         deep: true,
    //         handler() {

    //             let params = this.filter;

    //             const url = window.location.pathname + '?' + new URLSearchParams(params).toString();
    //             history.replaceState(null, '', url);
    //         }
    //     }

    // },

    computed: {
        visibleResources: function () {
            let resources = _cloneDeep(this.resources);

            return _.chain(resources)
                .orderBy(['is_featured', 'date'], ['desc', 'desc'])
                .filter(resource => {
                    let display = true;

                    // apply search
                    if (this.search !== "") {
                        var re = new RegExp(this.search, "gi");

                        if (resource.title.match(re) === null) {
                            display = false;
                        }
                    }

                    // apply resource type filter
                    if (this.filters.length) {
                        if (! this.filters.includes(resource.type)) {
                            display = false;
                        }
                    }

                    return display;
                })
                .value();
        }
    },

    methods: {
        resetFilters() {
            this.search = '';
            this.filters = [];
        }
    },

    mounted() {
        const query_string = window.location.search.split('?')[1];
        const params = new URLSearchParams(query_string);

        if (params.has('resource-type')) {
            this.filters.push(params.get('resource-type'));
        }
    }
});
