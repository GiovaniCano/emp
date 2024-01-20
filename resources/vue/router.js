import { createRouter, createWebHistory } from 'vue-router';
import login from './views/auth/login.vue';
import passIndex from './views/pass/index.vue';
import userService from './services/userService';

const routes = [
    {
        path: '/admin',
        children: [
            { path: 'login', component: login, name: 'login' },
            { path: 'pass', component: passIndex, name: 'pass.index' },
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// guards
router.beforeResolve((to, from, next) => {
    console.log(userService.user);
    if (to.name !== 'login' && !userService.user) return next({ name: 'login' }) // unauthorized
    if (to.name === 'login' && userService.user) return next({ name: 'pass.index' }) // already logged in
    else return next()
})

export default router