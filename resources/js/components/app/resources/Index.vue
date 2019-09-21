<template>
    <div>
        <AdminView v-if="user.is_admin"></AdminView>
        <UserView v-else></UserView>
    </div>
</template>

<script>
    import User from '../../../store/models/User';
    import AdminView from "./AdminView";
    import UserView from "./UserView";

    export default {
        name: "Index",
        components: {AdminView, UserView},
        /*
        * Before Resources component created: check auth
        *
        * @return void
        */
        beforeCreate() {
            if (!User.$auth()) this.$router.push({name: 'login'}); // TODO: middleware
        },

        /*
        * Computed propertis
        *
        * @return void
        */
        computed: {
            /*
            * Get the currnt user
            *
            * @return User
            */
            user() {
                return User.query().first();
            }
        }
    }
</script>

<style scoped>

</style>
