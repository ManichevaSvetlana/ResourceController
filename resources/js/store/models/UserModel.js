import { Model } from '@vuex-orm/core'
import User from "./User";
import UserRelatedModel from "./UserRelatedModel";
import VuexModel from "../VuexModel";

export default class UserModel extends VuexModel {
    static entity = 'users_models';

    static fields () {
        return {
            id: this.increment(),
            name: this.attr(''),
            user_id: this.attr(null),
            user: this.belongsTo(User, 'user_id'),
            user_related_models: this.hasMany(UserRelatedModel, 'user_model_id'),
        }
    }

    static methodConf = {
        http: {
            url: '/users_models'
        }
    }

}


