import {Model} from '@vuex-orm/core'
import UserModel from "./UserModel";
import router from '../../router'
import VuexModel from "../VuexModel";

export default class User extends VuexModel {
    static entity = 'users';

    static defaults = 'User';

    static fields() {
        return {
            id: this.increment(),
            name: this.attr(''),
            email: this.attr(''),
            user_models: this.hasMany(UserModel, 'user_id'),

            access_token: this.attr(''),
            expires_in: this.attr(3600),
            token_type: this.attr('bearer'),
        }
    }

    static methodConf = {
        http: {
            url: '/auth'
        },
        methods: {
            $create: {
                name: 'get',
                http: {
                    url: '/login',
                    method: 'post',
                },
            },
            $delete: {
                name: 'delete',
                http: {
                    url: '/logout',
                    method: 'post',
                },
            }
        }
    }

    /*
    * Login to the application (with the $create function)
    *
    * @return Promise
    */
    static $login(form) {
        return new Promise((resolve, reject) => {
            this.$create({
                data: form
            }).then(user => {
                localStorage.setItem('auth__token', user.access_token)
                localStorage.setItem('auth__token_end', new Date().getTime() + user.expires_in)
                localStorage.setItem('auth__user', JSON.stringify({
                    id: user.id,
                    name: user.name,
                    email: user.email,
                    access_token: user.access_token,
                }))
                router.push({name: 'dashboard'});
                resolve(user)
            }).catch(error => {
                console.log(error)
                reject(error)
                Vue.prototype.$notifyError(error)
            });
        });

    }

    /*
    * Logout from the application (with the $delete function)
    *
    * @return Promise
    */
    static $logout() {
        let user = User.query().first();
        if(user) return new Promise((resolve, reject) => {
            this.$delete({
                params: {id: user.id}
            }).then(user => {
                super.$removeAuth()
                resolve(true);
            }).catch(error => {
                reject(error)
                Vue.prototype.$notifyError(error)
            });
        });
        return false;
    }

    /*
    * Check if the user is authenticated
    *
    * @return boolean
    */
    static $auth() {
        return !!localStorage.getItem('auth__token');
    }

}


