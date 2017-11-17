import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'

Vue.use(VueResource)
Vue.use(VueRouter)

// router components
const Landing = Vue.component('landing', require('./components/get-started/landing.vue').default);
const Detail = Vue.component('detail', require('./components/get-started/detail.vue').default);

// router
const router = new VueRouter({
	routes: [
		{
			name: 'landing',
			path: '/',
			component: Landing
		},
		{
			name: 'detail',
			path: '/:step',
			component: Detail
		}
	]
})

// vue
new Vue({

	router,

	data: {
		steps: steps
	}

}).$mount('#get-started')
