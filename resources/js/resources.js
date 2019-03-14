import _ from 'underscore'
import Vue from 'vue'

// element components
import Resource from './components/resources/resource.vue'

new Vue({

	el: '#resources',

	components: {
		Resource
	},

	data: {
		// data
		resources: content.resources,
		resource_types: content.resource_types,
		// state
		display_filter: false,
		// search and filters
		search: '',
		filter_resource_type: [],
		// open resource
		open_resource: null,
		original_url: window.location.protocol + '//' + window.location.hostname + window.location.pathname
	},

	computed: {

		visibleResources: function () {

			var resources = [];

			this.resources.forEach(function(resource) {

				if ( resource.display === true ) {
					resources.push(resource);
				}

			});

			return resources;

		},

		isFiltered: function() {
			return this.filter_resource_type.length;
		},

		socialLinks() {

			return {
				facebook: 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURI(this.open_resource.link),
				linkedin: 'https://www.linkedin.com/cws/share?url=' + encodeURI(this.open_resource.link),
				twitter: 'https://twitter.com/home?status=' + encodeURI(this.open_resource.title) + ' - ' + encodeURI(this.open_resource.link),
				email: 'mailto:?subject=' + encodeURI(this.open_resource.title) + '&amp;body=Hi,%0D%0A%0D%0AI thought you would be interested in this article on Open Contracting: ' + encodeURI(this.open_resource.title) + ' – ' + encodeURI(this.open_resource.link)
			};

		}

	},

	watch: {

		'search': function() {
			this.filter();
		},

		'filter_resource_type':  function () {
			this.filter();
		}

	},

	methods: {

		filter: function() {

			// reset all resources

			this.resources.forEach(function(resource, index) {
				resource.display = true;
			});

			// apply search

			if ( this.search !== "" ) {

				var re = new RegExp(this.search, "gi");

				this.resources.forEach(function(resource, index) {

					if ( resource.title.match(re) === null ) {
						resource.display = false;
					}

				});

			}

			// apply resource type filter

			if ( this.filter_resource_type.length ) {

				this.resources.forEach(function(resource, index) {

					if ( ! intersection(Object.keys(resource.taxonomies['resource-type']), this.filter_resource_type) ) {
						resource.display = false;
					}

				}.bind(this));

			}


		},

		reset: function() {
			this.search = "";
			this.filter_resource_type = [];
		},

		hasTerms: function(taxonomy) {
			return Object.keys(taxonomy).length > 0;
		},

		openResource: function(payload) {

			var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

			if ( width > 810 ) {

				payload.event.preventDefault();

				this.open_resource = payload.resource;

				history.pushState({resource_id: payload.resource.id}, null, payload.resource.link);

			}

		},

		closeResource: function(update_url) {

			// close the current resource
			this.open_resource = null;

			// return back to the resources url
			if ( update_url !== false ) {
				history.pushState({}, null, this.original_url);
			}

		},

		encodeURI: function(string) {
			string = string.replace('&nbsp;', ' ');
			return encodeURIComponent(string);
		},

		trackClick(action, label) {
			_gaq.push(['_trackEvent', 'Resources', action, label]);
		}

	},

	mounted() {

		setTimeout(function() {

			// remove the vue loading class, blocking access to the output
			$(this.$el).removeClass('vue-loading');

		}.bind(this), 250);

		window.addEventListener('popstate', function(event) {

			if ( event.state && typeof event.state.resource_id !== 'undefined' ) {

				// filter the resources to match by id
				var result = $.grep(this.resources, function(e){ return e.id == event.state.resource_id; });

				// if a result is returned, set the open resource
				if ( result.length ) {
					this.open_resource = result[0];
				}

			} else {

				// no resource has been specified, we must want to close
				// and return to the resources overview

				this.closeResource(false);

			}

		}.bind(this));

	}

});

var intersection = function (haystack, arr) {

	return arr.some(function (v) {
		return haystack.indexOf(v) >= 0;
	});

};
