import Vue from 'vue'

new Vue({

	el: '#archive-posts',

	data: {
		// data
		posts: content.posts,
		terms: content.terms,
		// filters
		filter_issue: [],
		term_search: ''
	},

	watch: {

		filter_issue: function() {
			this.filter();
		},

		term_search: function() {
			this.filterTerms();
		}

	},

	computed: {

		visibleTerms: function() {

			var terms = [];

			this.terms.forEach(function(term) {

				if ( term.display === true ) {
					terms.push(term);
				}

			});

			if ( ! this.term_search ) {
				terms = terms.slice(0, 10);
			}

			return terms;

		}

	},

	methods: {

		increaseLimit: function() {

			if ( this.limit < this.posts.length ) {
				this.limit += 12;
			}

		},

		filter: function() {

			// reset all resources

			this.posts.forEach(function(post, index) {
				post.display = true;
			});

			// apply issue filter

			if ( this.filter_issue.length ) {

				this.posts.forEach(function(post, index) {

					if ( intersection(Object.keys(post.taxonomies['issue']), this.filter_issue).length === 0 ) {
						post.display = false;
					}

				}.bind(this));

			}


		},

		filterTerms: function() {

			// reset all resources

			this.terms.forEach(function(term, index) {
				term.display = true;
			});

			// apply issue filter

			if ( this.term_search.length ) {

				this.terms.forEach(function(term, index) {
					term.display = !! ~ term.name.toLowerCase().indexOf(this.term_search.toLowerCase());
				}.bind(this));

			}

		}

	}

});
