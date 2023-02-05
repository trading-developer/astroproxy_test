import { defineAsyncComponent } from "vue"
import { createRouter, createWebHistory } from "vue-router"
import AuthPage from "../pages/auth/AuthPage.vue";
import HomePage from "../pages/HomePage.vue";
import UsersPage from "../pages/users/Index.vue";
import UserViewPage from "../pages/users/View.vue";
import UserCreatePage from "../pages/users/Create.vue";
import ServicesPage from "../pages/services/Index.vue";

const adminPrefix = '/admin/'

const routes = [
    {
        path: adminPrefix + 'auth',
        name: 'Auth',
        meta: {
            require_auth: false,
            withoutLayOut:true,
        },
        component: AuthPage
    },
    {
        path: adminPrefix + '',
        name: 'Main',
        meta: {
            header: "Главная страница",
            require_auth: true,
        },
        component: HomePage
    },
    {
        path: adminPrefix + 'users',
        name: 'Users',
        meta: {
            require_auth: true,
        },
        component: UsersPage
    },
    {
        path: adminPrefix + 'users/:id',
        name: 'UserView',
        meta: {
            require_auth: true,
        },
        component: UserViewPage
    },
    {
        path: adminPrefix + 'users/create',
        name: 'UserCreate',
        meta: {
            require_auth: true,
        },
        component: UserCreatePage
    },
    {
        path: adminPrefix + 'services',
        name: 'Services',
        meta: {
            require_auth: true,
        },
        component: ServicesPage
    },



    // {
    //     path: adminPrefix + 'enter_point',
    //     name: 'EnteryPoint',
    //     redirect: adminPrefix + 'home',
    //     meta: {
    //         require_auth: false,
    //     },
    //     component: EnteryPoint
    // },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.require_auth)) {
        if (localStorage.getItem('token')) {
            next()
        } else {
            next(adminPrefix + 'auth')
        }
    } else {
        next()
    }
})

export default router
