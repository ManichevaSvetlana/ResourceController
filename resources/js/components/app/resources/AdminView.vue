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
                <a-layout style="padding: 0 24px 24px; background: white">
                    <a-layout-content :style="{ background: 'white', padding: '24px', margin: 0, minHeight: '280px' }">
                        <resources-table :columns="activeItem.columns" :element="activeItem.element"></resources-table>
                    </a-layout-content>
                </a-layout>
            </a-layout>
        </a-layout>
    </div>
</template>
<script>
    import {UserModel, UserRelatedModel, AdminModel} from '../../../store/models';

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
                        }, {
                            title: 'Name',
                            dataIndex: 'name',
                            editable: true,
                            type: 'text',
                        }, {
                            title: 'User',
                            dataIndex: 'user_id',
                            editable: true,
                            type: 'select',
                            selectMethod: 'user'
                        }]
                    },
                    {
                        element: UserRelatedModel,
                        name: 'User Related Models Through',
                        columns: [{
                            title: 'Id',
                            dataIndex: 'id',
                        }, {
                            title: 'Name',
                            dataIndex: 'name',
                            editable: true,
                            type: 'text',
                        }, {
                            title: 'User Model',
                            dataIndex: 'user_model_id',
                            editable: true,
                            type: 'select',
                            selectMethod: 'user_model'
                        }]
                    },
                    {
                        element: AdminModel,
                        name: 'Admin Models',
                        columns: [{
                            title: 'Id',
                            dataIndex: 'id',
                        }, {
                            title: 'Name',
                            dataIndex: 'name',
                            editable: true,
                            type: 'text',
                        }]
                    },

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
