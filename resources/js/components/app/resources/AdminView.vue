<template>
    <div>
        <a-layout style="background: white">
            <a-layout>
                <a-layout-sider width="200" style="background: #fff">
                    <a-menu
                        style="width: 256px"
                        mode="vertical"
                    >
                        <a-menu-item :key="element.name" v-for="element in elements" @click="setActiveItem(element)">
                            {{element.name}}
                        </a-menu-item>
                    </a-menu>
                </a-layout-sider>
                <a-layout style="padding: 0 24px 24px; background: white; ">
                    <a-layout-content :style="{ background: 'white', margin: 0, minHeight: '280px' }">
                        <h2 style="color: rgb(104, 106, 111);">{{activeItem.name}}</h2>
                        <resources-table :columns="activeItem.columns" :element="activeItem.element"></resources-table>
                    </a-layout-content>
                </a-layout>
            </a-layout>
        </a-layout>
    </div>
</template>
<script>
    import {User, AdminAccessModel, UserModel, UserRelatedModel} from '../../../store/models';

    export default {
        data(){
            return{
                activeItem: null,
                elements: [
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
        created()
        {
            this.activeItem = this.elements[0];
        },
        methods: {
            setActiveItem(element)
            {
                this.activeItem = element;
            }
        },
    }

</script>
<style>
    .ant-layout-sider-dark{
        flex: 0 0 255px !important;
        max-width: 300px !important;
        min-width: 200px;
        width: 255px !important;
        background: rgb(255, 255, 255);
    }
</style>
