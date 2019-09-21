<template>
    <div>
        <!--Resources table-->
        <a-table :columns="columns" :dataSource="data" :loading="loading" :pagination="false" bordered>
            <!--Resources columns (fields)-->
            <template v-for="col in columns" :slot="col.dataIndex" slot-scope="text, record, index">
                <!--Editable columns-->
                <div :key="col.dataIndex" v-if="col.editable">
                    <div v-if="record.editable">
                        <a-select
                            showSearch
                            :notFoundContent="null"
                            :defaultActiveFirstOption="false"
                            :showArrow="false"
                            :filterOption="false"
                            style="width: 100%; margin: -5px 0"
                            :placeholder="col.selectPlaceholder"
                            v-if="col.type == 'select'"
                            @search="(value) => { handleSearch(value, col) }"
                            @change="(value) => { handleChange(value, col, record) }"
                        >
                            <a-select-option v-for="item in col.selectOptions" :key='item.id + " , " + item.name'>{{item.name}}</a-select-option>
                        </a-select>
                        <a-input
                            style="margin: -5px 0"
                            v-model="record[col.dataIndex]"
                            v-else
                        />
                    </div>
                    <template v-else>{{record[col.dataIndex]}}</template>
                </div>
                <!--End of Editable columns-->
                <!--Not editable columns-->
                <div :key="col.dataIndex" v-else>
                    <template>{{record[col.dataIndex]}}</template>
                </div>
                <!--End of Not editable columns-->
            </template>
            <!--End of Resources columns (fields)-->
            <!--Actions column in the table-->
            <template slot="operation" slot-scope="text, record, index">
                <!--Dropdown with actions: edit | delete-->
                <a-dropdown :trigger="['click']"  v-if="!record.editable">
                    <a class="ant-dropdown-link" href="#">
                        Action
                        <a-icon type="down"/>
                    </a>
                    <a-menu slot="overlay">
                        <a-menu-item key="1">
                            <a @click="() => edit(record.key)">Edit</a>
                        </a-menu-item>
                        <a-menu-item key="0">
                            <a-popconfirm
                                title="Sure to delete?"
                                @confirm="() => destroy(record)">
                                <a href="javascript:;">Delete</a>
                            </a-popconfirm>
                        </a-menu-item>
                    </a-menu>
                </a-dropdown>
                <!--End of Dropdown with actions: edit | delete-->
                <!--Save/ Cancel th edited record-->
                <div class='editable-row-operations' v-else>
                    <span>
                        <a @click="() => save(record.key)" class="success">Save</a>
                        <a-popconfirm title='Sure to cancel?' @confirm="() => cancel(record.key)">
                            <a class="error">Cancel</a>
                        </a-popconfirm>
                    </span>
                </div>
                <!--End of Save/ Cancel th edited record-->
            </template>
            <!--End of Actions column in the table-->
        </a-table>
        <!--End of Resources table-->
        <br>
        <br>
        <!--Pagination numbers-->
        <a-row type="flex">
            <a-col :span="12" :order="2">
                <a-pagination :total="pagination.total" :pageSize="10" @change="changePage"
                              style="float:right"/>
            </a-col>
        </a-row>
        <!--End of pagination numbers-->
    </div>
</template>
<script>

    export default {
        props: ['columns', 'element'],
        data() {
            return {
                cacheData: [],
                data: [],
                total: 0,
                loading: false,
                pagination: {total: 0, current_page: 0}
            }
        },
        /**
         * Vue created component: load resources
         *
         * @return void
         */
        created() {
            this.clickFirstPage()
        },
        /*
        * Watched variables
        */
        watch: {
                /**
                 * If the element (model) changes => load resources
                 *
                 * @return void
                 */
                element() {
                    this.clickFirstPage()
                },
         },
        methods: {
            handleChange(value, column, record)
            {
                let arr = value.split(" , ");

                record[column.dataIndex] = arr[1];
                record[column.selectProperty] = arr[0];
            },
            handleSearch(value, column)
            {
                column.searchElement.$search({field: column.searchField, search: value}).then(response => {
                    column.selectOptions= response.result;
                }).catch(error => {this.$notifyError(error);})
            },
            destroy(record) {
                let resource = Object.assign({}, record);
                this.data = this.data.filter(item => item.id !== record.id);
                this.total--;

                this.element.$delete({
                    params: {id: record.id}
                }).catch(e => {
                    this.$notifyError(e);
                    this.data = [resource, ...this.data];
                    this.total ++;

                    this.cacheData = this.data.map(item => ({ ...item }))
                })
            },
            /**
             * Show the edit form
             *
             * @return void
             */
            edit(key) {
                const newData = [...this.data]
                const target = newData.filter(item => key === item.id)[0]
                if (target) {
                    target.editable = true
                    this.data = newData
                }
            },
            /**
             * Save the edited record
             *
             * @return void
             */
            save(key) {
                const newData = [...this.data]
                const target = newData.filter(item => key === item.id)[0]
                if (target) {
                    this.element.$update({
                        params: {id: key},
                        data: target
                    }).then(response => {
                        delete target.editable
                        this.data = newData
                        this.cacheData = newData.map(item => ({...item}))
                    }).catch(e => {
                        this.$notifyError(e);
                        this.cancel(key)
                    })

                }
            },
            /**
             * Cancel editing the record
             *
             * @return void
             */
            cancel(key) {
                const newData = [...this.data]
                const target = newData.filter(item => key === item.id)[0]
                if (target) {
                    Object.assign(target, this.cacheData.filter(item => key === item.id)[0])
                    delete target.editable
                    this.data = newData
                }
            },
            /**
             * Click the first pagination page
             *
             * @return void
             */
            clickFirstPage() {
                let items = document.getElementsByClassName('ant-pagination-item-1');
                try {
                    items[0].click();
                    this.changePage(1);
                } catch (e) {
                    this.changePage(1);
                }
            },
            /**
             * Change page value and show elements
             *
             * @param page
             * @return void
             */
            changePage(page) {
                this.loading = true;
                this.element.$paginate(page).then(response => {
                    let data = response;
                    this.pagination.current_page = data.current_page;
                    this.pagination.total = data.total;
                    data.data.forEach(item => {
                        item.key = item.id
                    })
                    this.data = data.data;
                    this.cacheData = this.data.map(item => ({...item}))
                }).catch(e => {
                    this.$notifyError(e);
                }).finally(response => {
                    this.loading = false;
                });
            },

        },
    }
</script>
<style scoped>
    .editable-row-operations a {
        margin-right: 8px;
    }
</style>
