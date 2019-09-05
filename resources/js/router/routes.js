import Login from '../components/app/auth/Login.vue'
import Resources from '../components/app/resources/Index.vue'

export default [
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Resources,
    },
]
