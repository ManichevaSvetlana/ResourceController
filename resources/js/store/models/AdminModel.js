import { Model } from '@vuex-orm/core'
import VuexModel from "../VuexModel";

export default class AdminModel extends Model {
    static entity = 'admin_models';

    static fields () {
        return {
            id: this.increment(),
            name: this.attr(''),
        }
    }

    static methodConf = {
        http: {
            url: '/admin_models'
        }
    }
}


