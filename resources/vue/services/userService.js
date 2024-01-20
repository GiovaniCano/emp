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
        .then(res => router.push({name:'pass.index'}).then(() => router.go(0)) )
    },
    logout() {
        axios.post(route('logout'))
        .then(res => router.push({name:'login'}).then(() => router.go(0)) )
    },
    getCurrentUser() {
        return axios.get('/api/admin/user')
            .then(res => {
                const user = res.data.user
                if(!user) router.push({name:'login'})
                this.user = user
            })
    }
})