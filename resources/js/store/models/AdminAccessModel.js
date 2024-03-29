import {Model} from '@vuex-orm/core'

export default class AdminAccessModel extends Model {
    static entity = 'admin_models';

    static fields () {
        return {
            id: this.increment(),
            name: this.attr(''),
        }
    }

    static methodConf = {
        http: {
            url: '/admin-models'
        }
    }

}


