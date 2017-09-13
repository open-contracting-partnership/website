var filter_defaults = null;

import Vue from 'vue'
// import FilterSelect from './components/report/filter.vue'

const reports = new Vue({

	el: '#impact-stories',

	data: {
		stories: [],
		filters: [],
		types: [],
		countries: []
	},
	computed: {

		getStories: function() {
			return this.stories.slice(1);
		}

	},
	watch: {

		filters:  function () {
			this.filter();
		}

	},
	methods: {

		setData: function() {

			this.types = [];
			this.countries = [];

			this.stories.forEach(function(event) {

				this.types.push({
					"name": event.story_type[0].name,
					"slug": event.story_type[0].slug
				});

				this.countries.push({
					"name": event.country[0].name,
					"slug": event.country[0].slug
				});

			});

		},

		filter: function() {

			// console.log(item);

			// this.filters.push(item);

			// reset all resources

			// this.stories.forEach(function(story, index) {
			// 	story.display = true;
			// });

			// apply filters

			// if ( this.filters.length ) {
			//
			// 	this.stories.forEach(function(story, index) {
			//
			// 		// if ( ! intersection(Object.keys(story.taxonomies['story-type']), this.filter_story_type) ) {
			// 		// 	story.display = false;
			// 		// }
			//
			// 	}.bind(this));
			//
			// }


		},

	},

	mounted: function() {

		$.ajax({
			url: '/wp-json/ocp/v1/impact-stories',
			cache: false
		})
		.done(function(data) {

			// set the reports data
			this.stories = data;

			// refresh the filter incase filters have already been applied
			this.refreshFilter();

		}.bind(this));

	}

});
