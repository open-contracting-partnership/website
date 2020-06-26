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

		// search and filters
		search: '',
		filter: null
	},

	watch: {

		filter() {

			if ( this.filter ) {
				window.location.hash = this.filter;
			} else {
				window.location.hash = '';
			}

		}

	},

	computed: {

		visibleResources: function () {

			let resources = _cloneDeep(this.resources);

			resources = _filter(resources, resource => {

				let display = true;

				// apply search

				if ( this.search !== "" ) {

					var re = new RegExp(this.search, "gi");

					if ( resource.title.match(re) === null ) {
						display = false;
					}

				}

				// apply resource type filter

				if ( this.filter ) {

					if ( resource.type !== this.filter ) {
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

			if ( this.filter === event.target.value ) {
				this.filter = null;
			} else {
				this.filter = event.target.value;
			}

		}

	},

	mounted() {

		if ( window.location.hash ) {
			this.filter = window.location.hash.substr(1);
		}

	}

});
