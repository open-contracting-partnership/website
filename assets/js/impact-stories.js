import _ from 'underscore'
import Vue from 'vue'
import StoryFeatured from './components/impact-stories/featured.vue'
import StoryCard from './components/impact-stories/normal.vue'

const reports = new Vue({

	el: '#impact-stories',

	components: {
		StoryFeatured,
		StoryCard
	},

	data: {
		stories: [],
		filters: {
			type: null,
			country: null
		},
		types: {},
		countries: {}
	},
	computed: {

		visibleStories: function() {

			var stories = [];

			this.stories.forEach(function(story) {

				if ( story.display === true ) {
					stories.push(story);
				}

			});

			return stories;

		},

		hasVisibleStories: function() {
			return !! this.visibleStories.length;
		},

	},
	watch: {

		filters: {
			handler: function (val, oldVal) {
				this.filter();
			},
			deep: true
		}

	},
	methods: {

		setFilters: function() {

			// empty the current filter options
			this.types = {};
			this.countries = {};

			// find the types and countries from the stories
			this.stories.slice(1).forEach(function(story) {

				story.story_type.forEach(function(story_type) {

					this.types[story_type.slug] = {
						"name": story_type.name,
						"slug": story_type.slug
					};

				}.bind(this));

				story.country.forEach(function(story_country) {

					this.countries[story_country.slug] = {
						"name": story_country.name,
						"slug": story_country.slug
					};

				}.bind(this));

			}.bind(this));

			// make sure the filter options are orderes correctly
			_.sortBy(this.types, 'name');
			_.sortBy(this.countries, 'name');

		},

		filter: function() {

			// reset all resources
			this.stories.forEach(function(story, index) {
				story.display = true;
			});

			// apply filters
			if ( ! _.isEmpty(this.filters.type) ) {

				this.stories.forEach(function(story, index) {

					if ( _.intersection(_.pluck(story.story_type, 'slug'), [this.filters.type]).length === 0 ) {
						story.display = false;
					}

				}.bind(this));

			}

			if ( ! _.isEmpty(this.filters.country) ) {

				this.stories.forEach(function(story, index) {

					if ( _.intersection(_.pluck(story.country, 'slug'), [this.filters.country]).length === 0 ) {
						story.display = false;
					}

				}.bind(this));

			}

			// before we go, ensure the first story is always false
			// this is the featured item, so shouldn't be displayed

			this.stories[0].display = false;

		},

		resetFilter: function() {
			this.filters.type = null;
			this.filters.country = null;
		},

		toggleFilter: function(field, value) {

			if ( this.filters[field] === value ) {
				value = null;
			}

			this.filters[field] = value;

		}

	},

	mounted: function() {

		$.ajax({
			url: '/wp-json/ocp/v1/impact-stories',
			cache: false
		})
		.done(function(data) {

			// preset the display value so vue can watch it
			data.forEach(function(story) {
				story.display = true;
			});

			// set the reports data
			this.stories = data;

			// after the data has been applied, re-generate the filters
			this.setFilters();

			// and refresh the filter for the initial view
			this.filter();

		}.bind(this));

	}

});
