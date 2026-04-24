import Vue from 'vue/dist/vue.esm.js'
import getWordPressData from '@/js/wordpress-data';

const archive_resources_data = getWordPressData('archive-resource');

new Vue({
    el: '#resource-archive',

    data: {
        // data
        resources: archive_resources_data.resources || [],

        // search and filters
        search: '',
        filters: []
    },

    computed: {
        visibleResources: function () {
            return [...this.resources]
                .sort((a, b) => {
                    const aFeat = a.is_featured ? 1 : 0;
                    const bFeat = b.is_featured ? 1 : 0;
                    if (aFeat !== bFeat) return bFeat - aFeat;
                    if (a.date > b.date) return -1;
                    if (a.date < b.date) return 1;
                    return 0;
                })
                .filter(resource => {
                    if (this.search !== "") {
                        const re = new RegExp(this.search, "gi");

                        if (resource.title.match(re) === null) {
                            return false;
                        }
                    }

                    if (this.filters.length) {
                        if (! this.filters.includes(resource.type)) {
                            return false;
                        }
                    }

                    return true;
                });
        }
    },

    methods: {
        reset() {
            this.search = '';
            this.filters = [];
        },

        resetSearch() {
            this.search = '';
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
