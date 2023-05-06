import Vue from 'vue'
import VueRouter from "vue-router";
import DealComponent from "./components/DealComponent.vue";
import CreateAccountComponent from "./components/CreateAccountComponent.vue";
import LinkingComponent from "./components/LinkingComponent.vue";

Vue.use(VueRouter);

export default new VueRouter({
    mode:'history',

    routes:[
        {
            path:'/deals',
            component:DealComponent
        },
        {
            path:'/createAccount',
            component:CreateAccountComponent
        },
        {
            path:'/linking',
            component:LinkingComponent
        }

    ]

})
