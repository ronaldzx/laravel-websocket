import Vue from 'vue'
import VueRouter from 'vue-router'
import Example from './components/ExampleComponent.vue'
import TicketForm from './components/TicketForm.vue'
import Incidencias from './components/Incidencias.vue'
Vue.use(VueRouter)

export default new VueRouter({
    mode:'history',
    routes: [
        {
            path:'/example',
            name: 'example',
            component:Example
        },
        {
            path:'/ticket',
            name:'ticket_form',
            component:TicketForm
        },
        {
            path:'/tabla_incidencia',
            name:'tabla_incidencia',
            component:Incidencias
        }
    ],
    base: process.env.BASE_URL,
})