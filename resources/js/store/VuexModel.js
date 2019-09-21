import {Model} from '@vuex-orm/core'
import router from '../router'
import {User, AdminAccessModel, UserModel, UserRelatedModel} from './models';

class VuexModel extends Model {
    /*
    * Check if auth token expired: if yes => redirect to login page
    * TODO: token refresh
    *
    * @return boolean
    */
    static $checkAuth(){
        if (localStorage.getItem('auth__token')) {
            let end = localStorage.getItem('auth__token_end');
            if ((new Date()).getTime() > parseInt(end)) {
                this.$removeAuth() // TODO: token refresh
                return false;
            }
        }
        return true;
    }

    /*
    * Update auth token in all models
    *
    * @return void
    */
    static $updateToken() {
        let models = [User, AdminAccessModel, UserModel, UserRelatedModel];
        models.forEach(model => {
            model.methodConf.http.headers['Authorization'] = 'Bearer ' + localStorage.getItem('auth__token');
        })
    }

    /*
    * Remove auth info
    *
    * @return void
    */
    static $removeAuth() {
        localStorage.removeItem('auth__token')
        localStorage.removeItem('auth__token_end')
        localStorage.removeItem('auth__user')
        User.deleteAll()
        router.push({name: 'login'})
    }

    /*
    * Perform action (CRUD) with all checkouts
    *
    * @return Promise
    */
    static $performAction(action, data) {
        try {
            if (this.$checkAuth()) {
                VuexModel.$updateToken()
                return super[action](data)
            } else return new Promise((resolve, reject) => {
                if (action !== '$delete') reject({message: 'You need to login.'})
                else resolve(true)
            })
        } catch (error) {
            return new Promise((resolve, reject) => {
                reject(error)
            })
        }

    }

    /*
    * Create a new instance with all checkouts
    *
    * @return Promise
    */
    static $create(data) {
        return this.$performAction('$create', data)
    }

    /*
    * Delete an instance with all checkouts
    *
    * @return Promise
    */
    static $delete(data) {
        return this.$performAction('$delete', data)
    }

    /*
    * Update an instance with all checkouts
    *
    * @return Promise
    */
    static $update(data) {
        return this.$performAction('$update', data)
    }

    /*
    * Get an instance with all checkouts
    *
    * @return Promise
    */
    static $get(data) {
        return this.$performAction('$get', data)
    }

    /*
    * Fetch instances with all checkouts
    *
    * @return Promise
    */
    static $fetch(data) {
        return this.$performAction('$fetch', data)
    }

    /*
    * Fetch with pagination
    *
    * @return Promise
    */
    static $paginate(page) {
        return new Promise((resolve, reject) => {
            this.$fetch({
                query: {page: page}
            }).then(response => {
                this.insert({
                    data: response.data
                })
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    }

    /*
    * Fetch with pagination
    *
    * @return Promise
    */
    static $search(query) {
        return new Promise((resolve, reject) => {
            this.$fetch({
                query: query
            }).then(response => {
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    }
}

export default VuexModel

