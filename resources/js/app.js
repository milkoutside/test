import Vue from 'vue'
import router from "./router";
import IndexComponent from "./IndexComponent.vue";
import CreateAccountComponent from "./components/CreateAccountComponent.vue";
import DealComponent from "./components/DealComponent.vue";
import {Vuelidate} from "vuelidate";
require ('./bootstrap');

Vue.use(Vuelidate);
const app = new Vue({
    el:'#app',

    components:{
        IndexComponent,
        CreateAccountComponent,
        DealComponent
    }, router
})
