// store.js

import axios from 'axios';
import * as topojson from "topojson-client";
import _ from 'underscore'
import Vue from 'vue'
import Vuex from 'vuex'
import VueResource from 'vue-resource'

Vue.use(Vuex)
Vue.prototype.$http = axios

const state = {

	filters: {
		all: true,
		ocds: false,
		ocds_ongoing: false,
		ocds_implementation: false,
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

			_.each(state.countries.features, function(country) {
				countries[country.properties.iso_a2.toLowerCase()] = country.properties;
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
	}

}

const actions = {

	fetchCountries ({ commit, getters }) {

		const url = 'https://raw.githubusercontent.com/open-contracting-partnership/ocp-data/publish/oc-status/_map.json';

		Vue.prototype.$http.get(url).then(response => {

			// the _map.json file is in topojson format, lets convert the feature back to geojson
			const geojson = topojson.feature(response.data, response.data.objects.ne_50m_admin_0_countries)

			geojson.features.forEach((country) => {

				country.properties.filter_ocds_ongoing = typeof _.find(country.properties.publishers, {ocds_ongoing_data: true}) !== 'undefined';
				country.properties.filter_ocds_implementation = typeof _.find(country.properties.publishers, {ocds_implementation: true}) !== 'undefined';
				country.properties.filter_ocds_historic = typeof _.find(country.properties.publishers, {ocds_historic_data: true}) !== 'undefined';

				country.properties.filter_ocds =
					country.properties.filter_ocds_ongoing ||
					country.properties.filter_ocds_implementation ||
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
