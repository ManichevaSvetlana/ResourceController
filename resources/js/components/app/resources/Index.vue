<template>
<h1>resources</h1>
</template>

<script>
    import User from '../../../store/models/User';

    export default {
        name: "Index",
        /*
        * Before Resources component created: check auth
        *
        * @return void
        */
        beforeCreate() {
            if(!User.$auth()) this.$router.push({name: 'login'}); // TODO: middleware
        },
    }
</script>

<style scoped>

</style>
