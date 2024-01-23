import axios from "axios";
import router from '../router'
import { reactive } from "vue";
import { getUserHome } from '../helpers'

export default reactive({
    user: null,
    home: null,
    
    login(credentials) {
        axios.post('/api/admin/login', {
            email: credentials.email,
            password: credentials.password
        })
        .then(({data}) => {
            this.user = data.user
            this.home = getUserHome(this.user)
            const homeRoute = router.getRoutes().find(({name}) => name === this.home)
            window.location.href = homeRoute.path
        })
    },
    logout() {
        axios.post(route('logout'))
            .then(() => {
                // this.user = null
                // this.home = null
                window.location.href = '/admin/login'
            })
    },
    getCurrentUser() {
        return axios.get('/api/admin/auth-user')
            .then(({data}) => {
                this.user = data.user
                if(this.user) this.home = getUserHome(this.user)
            })
    },

    index() {
        return axios.get(route('user.index'))
            .then(({data}) => data.users)
    },
    store(data) {
        return axios.post(route('user.store'), data)
            .then(({data}) => data.user)
    },
    update(id, data) {
        return axios.put(route('user.update', id), data)
            .then(({data}) => data.user)
    },
    delete(id) {
        return axios.delete(route('user.destroy', id))
    },
})