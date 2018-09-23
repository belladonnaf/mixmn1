
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import App from './App.vue';

import APlayer from '@moefe/vue-aplayer';

Vue.use(APlayer);
Vue.config.productionTip = false;
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

const vm1 = new Vue({
    el: '#playlist',
		components:{ App },
		template: '<App/>',
});

const vm2 = new Vue({
    el: '#right-sidebar',
	  name: 'RightSidebar',
		methods:{
			setUIFav(val,sel_obj){
				var api_url = 'http://mix.mn1.net/api/settings/myui/set/' + val;
		    axios.get(api_url).then(response => {
					console.log(response.data);
					if(response.data.result == 'ok'){
						jQuery(".sel-ui").removeClass("active");
						sel_obj.addClass("active");						
					}
		    });
			},
			setGenreFav(val,sel_obj){
				var api_url = 'http://mix.mn1.net/api/settings/mygenre/set/' + val;
		    axios.get(api_url).then(response => {
					console.log(response.data);
					if(response.data.result == 'ok'){
						jQuery(".sel-genre").removeClass("active");
						sel_obj.addClass("active");						
					}
		    });
			}
			
		}
});

