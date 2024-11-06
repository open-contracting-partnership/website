import _ from 'underscore'
import Vue from 'vue'

const _intersection = require('lodash.intersection');

new Vue({
	el: '#impact-stories',

	data: {
        results_count: null,

		filters: {
			type: [],
			country: [],
			issue: [],
		}
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
        updateResultsCount() {
            this.$nextTick(function() {
                this.results_count = [...document.querySelectorAll('.impact-stories__posts > .card-primary')]
                    .map(element => element.style.display)
                    .filter(display => display !== 'none')
                    .length;
            });
        },

        isFilterSet(type, id) {
            return this.filters[type].includes(id.toString());
        },

        addFilter(event, type, id) {
            event.target.value = '';
            this.filters[type].push(id);
        },

        removeFilter(type, id) {
            const index = this.filters[type].indexOf(id.toString());

            if (index > -1) {
                this.filters[type].splice(index, 1);
            }
        },

		filter() {
			Object.keys(this.$refs).forEach(key => {
				const $story = this.$refs[key];
				const country_ids = JSON.parse($story.getAttribute('data-country-ids'));
				const story_type_ids = JSON.parse($story.getAttribute('data-story-type-ids'));
				const issue_ids = JSON.parse($story.getAttribute('data-issue-ids'));

				//  remove any existing display styles
				$story.style.display = null;

				if (this.filters.type.length) {
					if (_intersection(story_type_ids, this.filters.type).length === 0) {
						$story.style.display = 'none';
					}
				}

				if (this.filters.country.length) {
					if (_intersection(country_ids, this.filters.country).length === 0) {
						$story.style.display = 'none';
					}
				}

				if (this.filters.issue.length) {
					if (_intersection(issue_ids, this.filters.issue).length === 0) {
						$story.style.display = 'none';
					}
				}
			});

            this.updateResultsCount();
		}
	},

    mounted() {
        this.updateResultsCount();
    }
});
