import Vue from 'vue';
import Vuex from 'vuex';
import VuexORM from '@vuex-orm/core';
import VuexORMAxios from '@vuex-orm/plugin-axios'
import VuexOrmCrudApi from '@peterquentin/vuex-orm-crud-api';
// models
import {User, AdminModel, UserModel, UserRelatedModel} from './models';

Vue.use(Vuex);

const database = new VuexORM.Database();
VuexORM.use(VuexOrmCrudApi, {
  database,
});

database.register(User, {});
database.register(AdminModel, {});
database.register(UserModel, {});
database.register(UserRelatedModel, {});

VuexORM.use(VuexORMAxios, {
    database,
    http: {
        baseURL: 'http://127.0.0.1:8000/api/',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('auth__token')
        }
    }
})
export default new Vuex.Store({
    plugins: [VuexORM.install(database)],
});
