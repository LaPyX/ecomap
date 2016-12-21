
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

Vue.http.interceptors.push(function(request, next) {
    var input = JSON.parse(Laravel);
    request.headers.set('X-CSRF-TOKEN', input.csrfToken);

    next();
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Controls
Vue.component('input-block', require('./components/controls/Input.vue'));
Vue.component('email-block', require('./components/controls/Email.vue'));
Vue.component('checkbox-block', require('./components/controls/Checkbox.vue'));
Vue.component('option-block', require('./components/controls/Option.vue'));
Vue.component('password-block', require('./components/controls/Password.vue'));
Vue.component('select-block', require('./components/controls/Select.vue'));
Vue.component('text-block', require('./components/controls/Text.vue'));
Vue.component('textarea-block', require('./components/controls/Textarea.vue'));
Vue.component('file-block', require('./components/controls/File.vue'));
Vue.component('button-block', require('./components/controls/Button.vue'));

Vue.component('request-form', require('./components/Forms/RequestForm.vue'));
Vue.component('request-info', require('./components/Forms/RequestInfo.vue'));
Vue.component('request-region', require('./components/Forms/RequestRegion.vue'));

Vue.component('loader', require('./components/Loader.vue'));
Vue.component('app', require('./components/App.vue'));

const app = new Vue({
    el: '#app'
});
