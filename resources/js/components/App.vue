<template>
    <div>
        <div>
            <a-menu
                mode="horizontal"
            >
                <a-menu-item key="dashboard" v-if="user && user.access_token">
                    <router-link :to="{ name: 'dashboard' }"><a-icon type="home" /> Dashboard</router-link>
                </a-menu-item>
                <a-menu-item key="logout" v-if="user && user.access_token" @click="logout">
                    <a><a-icon type="user"/> Logout</a>
                </a-menu-item>
                <a-menu-item key="auth" v-else>
                    <router-link :to="{ name: 'login' }"><a-icon type="user" /> Login</router-link>
                </a-menu-item>
            </a-menu>
        </div>

        <div style="margin-top: 30px;">
            <router-view></router-view>
        </div>

        <notifications group="notif" />
    </div>

</template>

<script>
    import User from '../store/models/User';

    export default {
        name: "App",
        data()
        {
            return{
            }
        },
        /*
        * Before App component created: check auth
        *
        * @return void
        */
        beforeCreate() {
            if(!User.$auth()) this.$router.push({name: 'login'}); // TODO: middleware
        },
        computed: {
            /*
            * Computed value: user (Vuex model)
            *
            * @return Model
            */
            user()
            {
                return User.query().first()
            }
        },
        methods: {
            /*
            * Logout from the application
            *
            * @return void
            */
            logout()
            {
                User.$logout()
            }
        }

    }
</script>

<style scoped>

</style>
