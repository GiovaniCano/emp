import { createRouter, createWebHistory } from 'vue-router';
import { getUserPermissionsNames, getUserRolesNames } from './helpers';
import userService from './services/userService';

const login = () => import('./views/auth/login.vue');
const adminIndex = () => import('./views/superadmin/index.vue');
const passIndex = () => import('./views/pass/index.vue');
const articleIndex = () => import('./views/article/index.vue');
const notFound = () => import('./views/404.vue')

const routes = [
    {
        path: '/admin',
        children: [
            { 
                path: 'login',
                component: login,
                name: 'login',
                meta: { auth: false },
            },
            { 
                path: 'admin',
                component: adminIndex,
                name: 'admin.index',
                meta: { auth: true, roles: ['super admin'] },
            },
            { 
                path: 'pass',
                component: passIndex,
                name: 'pass.index',
                meta: { auth: true, permissions: ['manage site'] },
            },
            { 
                path: 'article',
                component: articleIndex,
                name: 'article.index',
                meta: { auth: true, permissions: ['edit articles'] },
            },
            { path: '/:pathMatch(.*)*', name: '404', component: notFound, },
        ]
    }
]

// router
const router = createRouter({
    history: createWebHistory(),
    routes
})

// guards
router.beforeEach((to, from, next) => {
    const requireAuth = to.meta.auth ?? null
    const user = userService.user

    if(requireAuth === true && !user) return next({name:'404'}) // unauthenticated

    const home = userService.home

    if(requireAuth === false && user) return next({name:home}) // already logged in

    // roles
    const allowedRoles = to.meta.roles ?? []
    if(allowedRoles.length > 0) {
        const userRoles = getUserRolesNames(user)
        if( !allowedRoles.some(role => userRoles.includes(role)) ) { 
            return next({name:home})
        }
    }

    // permissions
    const allowedPermissions = to.meta.permissions ?? []
    if(allowedPermissions.length > 0) {
        const userPermissions = getUserPermissionsNames(user)
        if( !allowedPermissions.some(permission => userPermissions.includes(permission)) ) { 
            return next({name:home})
        }
    }

    return next()
})

// role:super admin|admin|writer
// permission:edit settings|manage site|scan tickets|edit articles

export default router