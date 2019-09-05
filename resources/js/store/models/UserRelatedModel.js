import { Model } from '@vuex-orm/core'
import UserModel from "./UserModel";

export default class UserRelatedModel extends Model {
    static entity = 'users_related_models';

    static fields () {
        return {
            id: this.increment(),
            name: this.attr(''),
            user_model_id: this.attr(null),
            user_model: this.belongsTo(UserModel, 'user_model_id'),
        }
    }

    static methodConf = {
        http: {
            url: '/users_related_models'
        }
    }
}



