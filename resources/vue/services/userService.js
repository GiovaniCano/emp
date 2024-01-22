import axios from "axios";
import router from '../router'
import { reactive } from "vue";

export default reactive({
    user: null,
    
    login(credentials) {
        axios.post('/api/admin/login', {
            email: credentials.email,
            password: credentials.password
        })
        .then(() => router.push({name:'pass.index'}).then(() => router.go(0)) )
    },
    logout() {
        axios.post(route('logout'))
        .then(() => router.push({name:'login'}).then(() => router.go(0)) )
    },
    getCurrentUser() {
        return axios.get('/api/admin/auth-user')
            .then(({data}) => {
                const user = data.user
                if(!user) router.push({name:'login'})
                this.user = user
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