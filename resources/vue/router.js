import { createRouter, createWebHistory } from 'vue-router';
import login from './views/auth/login.vue';

const routes = [
    {
        path: '/admin',
        children: [
            { path: 'login', component: login, name: 'login' },
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router