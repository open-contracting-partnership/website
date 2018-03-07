import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

Vue.component('diamonds', require('./components/get-started/diamonds.vue'));

// router
const router = new VueRouter({
	routes: [
		{
			name: 'landing',
			path: '/',
			component: require('./components/get-started/landing.vue')
		},
		{
			name: 'detail',
			path: '/:step',
			component: require('./components/get-started/detail.vue')
		}
	]
})

// vue
new Vue({

	router,

	data: {
		landing_content: landing_page,
		steps: steps
	}

}).$mount('#get-started')
