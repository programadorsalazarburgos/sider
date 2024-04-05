import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/js/components/Home';
import Home from '@/js/components/About';


Vue.use(VueRouter);

const router = new VueRouter({
mode: 'history',
routes: [
	{
  		path: '/foo', 
  		component: require('./components/Notification.vue'),
		name: 'home'
	}
	
]

});

export default router;