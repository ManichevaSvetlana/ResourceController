<template>
    <a-row>
        <a-col :span="8"></a-col>
        <a-col :span="8">
            <a-form
                id="components-form-demo-normal-login"
                :form="form"
                class="login-form"
                @submit="login"
            >
                <a-form-item>
                    <a-input
                        v-decorator="['email', { rules: [{ required: true, message: 'Please input your email!' }] }]"
                        placeholder="email" >
                        <a-icon
                            slot="prefix"
                            type="user"
                            style="color: rgba(0,0,0,.25)"
                        />

                    </a-input>
                </a-form-item>
                <a-form-item>
                    <a-input
                        v-decorator="['password', { rules: [{ required: true, message: 'Please input your password!' }] }]"
                        type="password"
                        placeholder="Password" >
                        <a-icon
                            slot="prefix"
                            type="lock"
                            style="color: rgba(0,0,0,.25)"
                        />
                    </a-input>
                </a-form-item>
                <a-form-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                        class="login-form-button"
                    >
                        Log in
                    </a-button>
                </a-form-item>
            </a-form>
        </a-col>
        <a-col :span="8"></a-col>
    </a-row>
</template>


<script>
    import User from '../../../store/models/User';

    export default {
        name: "Login",
        data() {
            return {
                email: '', // User's email
                password: '' // User's password
            }
        },
        /*
        * Before Login component created: check auth & create the form
        *
        * @return void
        */
        beforeCreate() {
            if(User.$auth()) this.$router.push({name: 'dashboard'}); // TODO: middleware
            this.form = this.$form.createForm(this);
        },
        methods: {
            /*
            * Login to the application after validation email & password
            *
            * @param e
            * @return void
            */
            login(e)
            {
                e.preventDefault();
                this.form.validateFields((err, values) => {
                    if (!err) {
                        User.$login(values)
                    }
                });
            },
        }
    }
</script>

<style>
    #components-form-demo-normal-login .login-form {
        max-width: 300px;
    }

    #components-form-demo-normal-login .login-form-forgot {
        float: right;
    }

    #components-form-demo-normal-login .login-form-button {
        width: 100%;
    }
</style>
