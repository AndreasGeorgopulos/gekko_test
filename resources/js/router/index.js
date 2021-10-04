import Vue from "vue"
import VueRouter from "vue-router"
import Find from "../views/Find.vue"
import Create from "../views/Create.vue"

Vue.use(VueRouter)

const routes = [
    {
        path: "/",
        name: "Find",
        component: Find
    },
    {
        path: "/create-secret",
        name: "Create",
        component: Create
    },
]

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
})

export default router
