import { sync } from 'vuex-router-sync'
import Vue from 'vue'
import VueRouter from 'vue-router'
// import Raven from 'raven-js';
// import RavenVue from 'raven-js/plugins/vue';
import _ from 'underscore';
import store from './store'

Vue.use(VueRouter)

// Raven
// 	.config('https://0bd6363074584cbcaeab1e66d004ed5a@sentry.io/296260')
// 	.addPlugin(RavenVue, Vue)
// 	.install();

// route components
import Table from './components/table.vue';
import Map from './components/map.vue';

// element components
import Flag from './components/flag.vue';
import Tick from './components/tick.vue';
import Country from './components/country.vue';
import DataTable from './components/table.vue';
import OCDSStatus from './components/ocds-status.vue';
import CountrySearch from './components/search.vue';
import CountryFilter from './components/filter.vue';

// register components
Vue.component('flag', Flag);
Vue.component('tick', Tick);
Vue.component('country', Country);
Vue.component('data-table', DataTable);
Vue.component('ocds-status', OCDSStatus);
Vue.component('country-search', CountrySearch);
Vue.component('country-filter', CountryFilter);

// router
const router = new VueRouter({
	routes: [
		{
			name: 'table',
			path: '/table',
			component: Table
		},
		{
			name: 'map',
			path: '/',
			component: Map,
			children: [
				{
					name: 'country',
					path: ':code'
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
