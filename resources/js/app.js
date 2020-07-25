/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

axios.defaults.headers.common['Authorization'] = 'Bearer ' + document.head.querySelector('meta[name="token"]').content;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('regions', require('./components/region/Tree.vue').default);
Vue.component('comments', require('./components/entry/Comments.vue').default);
Vue.component('users', require('./components/user/Users.vue').default);
Vue.component('vue-pagination', require('./components/common/Pagination.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.filter('to_3dp', function (value) {
	if (isNaN(value) || value === '' || value === true || value === null || value === undefined)
	{
		return 0.00;
	}
	else if (parseFloat(value) % 1 === 0)
	{
		return parseFloat(value);
	}
	else
	{
		var match = value.toString().match(/^-?\d+(?:\.\d{0,3})?/g); // ndp = 3

		return match
			? match[0] 
			: parseFloat(value);
	}
})

const app = new Vue({
    //el: '#app',
    el: '.vuepart',
});
