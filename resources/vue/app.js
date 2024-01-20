import '../js/bootstrap';

import { createApp } from 'vue';
import App from './App.vue'
import router from './router'
import userService from './services/userService'

userService.getCurrentUser()
    .then(() => {
        const app = createApp(App)
        app.use(router)
        app.mount('#app')
    })