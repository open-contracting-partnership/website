// store.js

import * as topojson from "topojson-client";
import Vue from 'vue/dist/vue.esm.js'
import Vuex from 'vuex'
import VueResource from 'vue-resource'

Vue.use(Vuex)
Vue.use(VueResource)

const state = {
    filters: {
        all: true,
        ocds: false,
        ocds_ongoing: false,
        ocds_historic: false,
        commitments: false,
        innovations: false
    },

    content: null,
    countries: null
}

const getters = {
    filters(state, getters) {
        return state.filters;
    },

    countries(state, getters) {
        let countries = {};

        if ( state.countries ) {
            state.countries.features.forEach(function(country) {
                // set the initial country object
                let country_object = country.properties;

                // we want to overwrite the given has_data property to only
                // report true if one of the following arrays is being used

                country_object.has_data =
                    country_object.innovations?.length > 0 ||
                    country_object.publishers?.length > 0 ||
                    country_object.ogp_commitments?.length > 0 ||
                    country_object.impacts_stories?.length > 0;

                // attempt to supliment additional publisher data
                (country_object.publishers || []).forEach(function(publisher) {
                    let status = null;

                    if ( typeof publisher.ocds_historic_data && publisher.ocds_historic_data === true ) {
                        status = {
                            slug: 'historic',
                            name: 'Historic'
                        }
                    }

                    if ( typeof publisher.ocds_ongoing_data && publisher.ocds_ongoing_data === true ) {
                        status = {
                            slug: 'ongoing',
                            name: 'Ongoing'
                        }
                    }

                    publisher.status = status;
                });

                // save all of the data to the countries object
                countries[country.properties.iso_a2.toLowerCase()] = country_object;
            });
        }

        return countries;
    },

    geo_countries(state, getters) {
        return state.countries;
    },

    selected_country(state, getters) {
        let country = null;

        if ( state.route.name === 'country' && typeof getters.countries[state.route.params.code] !== 'undefined' ) {
            country = getters.countries[state.route.params.code];
        }

        return country;
    },

    content(state, getters) {
        return state.content;
    }
}

const mutations = {
    setCountries(state, countries) {
        state.countries = countries;
    },

    setContent(state, content) {
        state.content = content;
    },

    toggleFilter(state, filter) {
        state.filters[filter] = ! state.filters[filter];

        // ocds parent trigger
        if ( filter === 'ocds' ) {
            state.filters['ocds_ongoing'] = state.filters['ocds'];
            state.filters['ocds_historic'] = state.filters['ocds'];
        }

        // ocds child trigger
        if ( ['ocds_ongoing', 'ocds_historic'].indexOf(filter) !== -1 ) {
            const enabled = state.filters['ocds_ongoing']
                || state.filters['ocds_historic'];

            state.filters['ocds'] = enabled;
        }
    }
}

const actions = {
    fetchCountries ({ commit, getters }) {
        const url = 'https://raw.githubusercontent.com/open-contracting-partnership/ocp-data/publish/oc-status/_map.json?test=okay';

        this._vm.$http.get(url).then(response => {
            // the _map.json file is in topojson format, lets convert the feature back to geojson
            const geojson = topojson.feature(response.data, response.data.objects.ne_50m_admin_0_countries)

            geojson.features.forEach((country) => {
                const publishers = country.properties.publishers || [];
                country.properties.filter_ocds_ongoing = publishers.some(p => p.ocds_ongoing_data === true);
                country.properties.filter_ocds_historic = publishers.some(p => p.ocds_historic_data === true);

                country.properties.filter_ocds =
                    country.properties.filter_ocds_ongoing ||
                    country.properties.filter_ocds_historic;

                country.properties.filter_commitments = ( typeof country.properties.ogp_commitments !== 'undefined' && country.properties.ogp_commitments.length > 0 );
                country.properties.filter_innovations = ( typeof country.properties.innovations !== 'undefined' && country.properties.innovations.length > 0 );
            });

            commit('setCountries', geojson);
        })
    },

    addContent ({ commit, getters }, content) {
        commit('setContent', content);
    },

    toggleFilter ({ commit, getters }, filter) {
        commit('toggleFilter', filter);
    }
}

export default new Vuex.Store({
    state,
    getters,
    actions,
    mutations
})
