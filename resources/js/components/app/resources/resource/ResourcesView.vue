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

     export default {
         props: ['elements'],
        data(){
            return{
                activeItem: null, // active menu item
            }
        },
        /**
         * Vue created component: set an active item
         *
         * @return void
         */
        created()
        {
            this.activeItem = this.elements[0];
        },
        methods: {
            /**
             * Set active item
             *
             * @param element
             * @return void
             */
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
