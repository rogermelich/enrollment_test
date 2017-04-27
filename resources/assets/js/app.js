
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/* Wizard */
Vue.component('wizard', require('./components/Wizard/Wizard.vue'));
Vue.component('wizard-step', require('./components/Wizard/WizardSteps.vue'));
/*Wizard Taps*/
Vue.component('user', require('./components/Enrollment/User.vue'));
Vue.component('person', require('./components/Enrollment/Person.vue'));
Vue.component('study', require('./components/Enrollment/Study.vue'));
Vue.component('course', require('./components/Enrollment/Course.vue'));
Vue.component('module', require('./components/Enrollment/Module.vue'));
Vue.component('submodule', require('./components/Enrollment/SubModule.vue'));


const app = new Vue({
    el: '#app'
});
