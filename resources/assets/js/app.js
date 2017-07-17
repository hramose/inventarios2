
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

/*Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});*/

Vue.component('example', require('./components/Example.vue'));

/***INI de passport*/

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

/***FIN de passport*/

$(function() {

    const app =new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue.js!',
            codigo_avianca: $('codigo_avianca').val(),
            value: '',
            oldValue: ''
        },
        watch: {
            codigo_avianca: function(val, oldVal) {
                this.value = val;
                this.oldValue = oldVal;
            }
        }
    });
    $('.dropdown-toggle').dropdown();
});
