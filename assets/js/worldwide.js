import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
import Raven from 'raven-js';
import RavenVue from 'raven-js/plugins/vue';
import _ from 'underscore';

Raven
	.config('https://0bd6363074584cbcaeab1e66d004ed5a@sentry.io/296260')
	.addPlugin(RavenVue, Vue)
	.install();

Vue.use(VueResource)
Vue.use(VueRouter)

// router
const router = new VueRouter({
	routes: [
		{
			name: 'map',
			path: '/',
			component: require('./components/worldwide/map.vue').default
		}
	]
})

// vue
new Vue({
	router
}).$mount('#worldwide')
