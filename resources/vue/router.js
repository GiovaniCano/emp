import { createRouter, createWebHistory } from 'vue-router';
import userService from './services/userService';
import login from './views/auth/login.vue';
import passIndex from './views/pass/index.vue';
import adminIndex from './views/superadmin/index.vue';

const routes = [
    {
        path: '/admin',
        children: [
            { path: 'login', component: login, name: 'login' },
            { path: 'pass', component: passIndex, name: 'pass.index' },
            { path: 'admin', component: adminIndex, name: 'admin.index' },
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// guards
router.beforeResolve((to, from, next) => {
    if (to.name !== 'login' && !userService.user) return next({ name: 'login' }) // unauthorized
    if (to.name === 'login' && userService.user) return next({ name: 'pass.index' }) // already logged in
    else return next()
})

export default router