import { createApp } from 'vue'
import router from "../admin/router";
import App from './App.vue'
import axios from "axios";

const token = localStorage.getItem('token')

axios.defaults.headers.common['Authorization'] =
    'Bearer ' + token

const _app = createApp(App)

_app.config.globalProperties.$hostname = window.location.origin
_app.use(router)


_app.mount('#app')

