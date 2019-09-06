<template>
    <div>
        <a-table :columns="columns" :dataSource="data" :loading="loading" :pagination="false" bordered>
            <template v-for="col in columns" :slot="col.name" slot-scope="text, record, index">
                <div :key="col.name" v-if="col.editable">
                    <a-input
                        v-if="record.editable"
                        style="margin: -5px 0"
                        :value="text"
                        @change="e => handleChange(e.target.value, record.key, col)"
                    />
                    <template v-else>{{text}}</template>
                </div>
                <div :key="col.name" v-else>
                    <template>{{text}}</template>
                </div>
            </template>
            <template slot="operation" slot-scope="text, record, index">
                <div class='editable-row-operations'>
        <span v-if="record.editable">
          <a @click="() => save(record.key)">Save</a>
          <a-popconfirm title='Sure to cancel?' @confirm="() => cancel(record.key)">
            <a>Cancel</a>
          </a-popconfirm>
        </span>
                    <span v-else>
          <a @click="() => edit(record.key)">Edit</a>
        </span>
                </div>
            </template>
        </a-table>
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
        data () {
            return {
                cacheData: [],
                data: [],
                total: 0,
                loading: false,
                pagination: {total: 0, current_page: 0}
            }
        },
        created()
        {
            this.clickFirstPage()
        },
        watch:
        {
            element()
            {
                this.clickFirstPage()
            }
        },
        methods: {
            handleChange (value, key, column) {
                const newData = [...this.data]
                const target = newData.filter(item => key === item.key)[0]
                if (target) {
                    target[column] = value
                    this.data = newData
                }
            },
            edit (key) {
                const newData = [...this.data]
                const target = newData.filter(item => key === item.key)[0]
                if (target) {
                    target.editable = true
                    this.data = newData
                }
            },
            save (key) {
                const newData = [...this.data]
                const target = newData.filter(item => key === item.key)[0]
                if (target) {
                    delete target.editable
                    this.data = newData
                    this.cacheData = newData.map(item => ({ ...item }))
                }
            },
            cancel (key) {
                const newData = [...this.data]
                const target = newData.filter(item => key === item.key)[0]
                if (target) {
                    Object.assign(target, this.cacheData.filter(item => key === item.key)[0])
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
                    let data = response.data;
                    this.pagination.current_page = data.current_page;
                    this.pagination.total = data.total;
                    this.data = data.data;
                    this.cacheData = this.data.map(item => ({ ...item }))
                }).catch(e => {
                    this.$notifyError(e);
                }).finally(response => {this.loading = false;});
            },

        },
    }
</script>
<style scoped>
    .editable-row-operations a {
        margin-right: 8px;
    }
</style>
