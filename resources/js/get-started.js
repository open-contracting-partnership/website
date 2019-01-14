import Vue from 'vue'
import VueRouter from 'vue-router'

// route components
import LandingComponent from './components/get-started/landing.vue';
import DetailComponent from './components/get-started/detail.vue';

// element components
import DiamondsComponent from './components/get-started/diamonds.vue';

Vue.component('diamonds', DiamondsComponent);

Vue.use(VueRouter)

// router
const router = new VueRouter({
	routes: [
		{
			name: 'landing',
			path: '/',
			component: LandingComponent
		},
		{
			name: 'detail',
			path: '/:step',
			component: DetailComponent
		}
	]
})

// vue
new Vue({

	router,

	data: {
		landing_content: content.landing_page,
		steps: content.steps
	}

}).$mount('#get-started')
