import Vue from 'vue'

// element components
import Event from './components/events/event.vue';

Vue.component('event', Event);

Vue.filter('reverse', function(value) {
	// slice to make a copy of array, then reverse the copy
	return value.slice().reverse();
});

new Vue({

	el: '#events',

	data: {
		// data
		events: content.events,
		// open event
		open_event: null,
		show_archived: false
	},

	computed: {

		futureEvents: function() {
			return this.getEvents();
		},

		pastEvents: function() {
			return this.getEvents(false).reverse();
		}

	},

	methods: {

		getEvents: function(is_future) {

			is_future = typeof is_future === 'undefined' ? true : is_future;

			var events = [];

			this.events.forEach(function(event) {

				if ( event.custom.is_future === is_future ) {
					events.push(event);
				}

			});

			return events;

		},

		hasTerms: function(taxonomy) {
			return Object.keys(taxonomy).length > 0;
		},

		openEvent: function(selected_event, event) {

			var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

			if ( width >= 768 ) {

				event.preventDefault();
				this.open_event = selected_event;

				history.pushState({event_id: selected_event.id}, null, '#' + selected_event.slug);

			}

		}

	},

	mounted() {

		var current_event = this.futureEvents[0];

		var event_index = 0;

		if ( location.hash ) {

			this.events.forEach(function(event, index) {

				if ( '#' + event.slug === location.hash ) {
					event_index = index;
				}

			});

		}

		if ( event_index !== 0 ) {
			this.open_event = this.events[event_index];
		} else {
			this.open_event = current_event;
		}

		window.addEventListener('popstate', function(event) {

			if ( event.state && typeof event.state.event_id !== 'undefined' ) {

				// filter the events to match by id
				var result = $.grep(this.events, function(e){ return e.id == event.state.event_id; });

				// if an event is returned, set the open event
				if ( result.length ) {
					this.open_event = result[0];
				}

			}

		});

	}

});
