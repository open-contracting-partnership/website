import { sync } from 'vuex-router-sync'
import Vue from 'vue'
import VueRouter from 'vue-router'
import Raven from 'raven-js';
import RavenVue from 'raven-js/plugins/vue';
import _ from 'underscore';

// Raven
// 	.config('https://0bd6363074584cbcaeab1e66d004ed5a@sentry.io/296260')
// 	.addPlugin(RavenVue, Vue)
// 	.install();

Vue.use(VueRouter)

import store from './components/worldwide/store'

Vue.component('flag', require('./components/flag.vue'));
Vue.component('tick', require('./components/worldwide/tick.vue'));
Vue.component('country', require('./components/worldwide/country.vue'));
Vue.component('ocds-status', require('./components/worldwide/ocds-status.vue'));
Vue.component('country-search', require('./components/worldwide/search.vue'));
Vue.component('country-filter', require('./components/worldwide/filter.vue'));

// router
const router = new VueRouter({
	routes: [
		{
			name: 'map',
			path: '/',
			component: require('./components/worldwide/map.vue'),
			children: [
				{
					name: 'country',
					path: ':code',
					component: require('./components/worldwide/country.vue')
				}
			]
		}
	]
})

const unsync = sync(store, router) // done. Returns an unsync callback fn

// vue
new Vue({

	router,
	store,

	mounted() {

		// initialise the data set
		store.dispatch('fetchCountries');
		store.dispatch('addContent', content);

	}

}).$mount('#worldwide')
