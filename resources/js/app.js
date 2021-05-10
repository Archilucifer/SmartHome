require('./bootstrap');

window.Vue = require('vue');

import Vuetify from "../plugins/vuetify";

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('homes', require('./components/Homes.vue').default);
Vue.component('climate', require('./components/Climate.vue').default);
Vue.component('rooms', require('./components/Rooms.vue').default);
Vue.component('devices', require('./components/Devices.vue').default);

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
});
