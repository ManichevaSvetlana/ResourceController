<template>
    <resources-view :elements="elements"></resources-view>
</template>
<script>
    import {User, UserModel, UserRelatedModel} from '../../../store/models';

    export default {
        data(){
            return{
                elements: [ // menu items with required info
                    {
                        element: UserModel,
                        name: 'User Related Models',
                        columns: [{
                            title: 'Id',
                            dataIndex: 'id',
                            scopedSlots: {customRender: 'id'},
                        }, {
                            title: 'Name',
                            dataIndex: 'name',
                            editable: true,
                            type: 'text',
                            scopedSlots: {customRender: 'name'},
                        }, {
                            title: 'User',
                            dataIndex: 'user_name',
                            editable: true,
                            type: 'select',
                            selectProperty: 'user_id',
                            searchElement: User,
                            selectOptions: [],
                            selectPlaceholder: 'Find a user by typing an email',
                            searchField: 'email',
                            scopedSlots: {customRender: 'user_name'},
                        }, {
                            title: 'operation',
                            dataIndex: 'operation',
                            scopedSlots: { customRender: 'operation' },
                        }]
                    },
                    {
                        element: UserRelatedModel,
                        name: 'User Related Models Through',
                        columns: [{
                            title: 'Id',
                            dataIndex: 'id',
                            scopedSlots: {customRender: 'id'},
                        }, {
                            title: 'Name',
                            dataIndex: 'name',
                            editable: true,
                            type: 'text',
                            scopedSlots: {customRender: 'name'},
                        }, {
                            title: 'User Model',
                            dataIndex: 'user_model_name',
                            editable: true,
                            type: 'select',
                            selectProperty: 'user_model_id',
                            searchElement: UserModel,
                            selectOptions: [],
                            selectPlaceholder: 'Find a user model by typing a name',
                            searchField: 'name',
                            scopedSlots: {customRender: 'user_model_name'},
                        }, {
                            title: 'operation',
                            dataIndex: 'operation',
                            scopedSlots: { customRender: 'operation' },
                        }]
                    },
                    // TODO: admin models

                ]
            }
        },
    }

</script>
