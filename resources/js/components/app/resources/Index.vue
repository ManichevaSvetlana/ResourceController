<template>
    <div>
        <AdminView v-if="user.is_admin"></AdminView>
    </div>
</template>

<script>
    import User from '../../../store/models/User';
    import AdminView from "./AdminView";

    export default {
        name: "Index",
        components: {AdminView},
        /*
        * Before Resources component created: check auth
        *
        * @return void
        */
        beforeCreate() {
            if (!User.$auth()) this.$router.push({name: 'login'}); // TODO: middleware
        },
        computed: {
            user() {
                return User.query().first();
            }
        }
    }
</script>

<style scoped>

</style>
