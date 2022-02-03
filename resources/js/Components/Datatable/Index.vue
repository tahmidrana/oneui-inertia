<template>
    <v-server-table :url="route('users.get-users')" :columns="columns" :options="options" />
</template>

<script>
export default {
    props: {
        columns: Array,
        selectable: {
            type: String,
            default: 'multiple',
        }
    },
    data () {
        return {
            options: {
                initialPage: 1,
                perPageValues: [10, 20, 50, 100],
                responseAdapter: function (resp) {
                    var data = this.getResponseData(resp);
                    return { data: data.data, count: data.total }
                },
                requestKeys: { query:'searchKey', limit:'limit', orderBy:'orderBy', ascending:'ascending', page:'page', byColumn:'byColumn' },
                sortIcon: { base:'fa', up:'fa-angle-up', down:'fa-angle-down', is:'fa-sort' },
                selectable: {
                    mode: 'multiple', // 'multiple'|'single'
                    only: function(row) {
                        return true // any condition
                    },
                    selectAllMode: 'page', // or 'page',
                    programmatic: false
                },
                templates: {
                    action: function (h, row, index) {
                        return `<button type="button">Delete</button>`
                        return `<button type="button" class="btn-block-option mr-2">
                                <i class="fa fa-plus mr-1"></i> Delete
                            </button>`
                    }
                }
                // filterByColumn: true,
                /* listColumns: {
                    animal: [{
                            id: 1,
                            text: 'Dog'
                        },
                        {
                            id: 2,
                            text: 'Cat',
                            hide:true
                        },
                        {
                            id: 3,
                            text: 'Tiger'
                        },
                        {
                            id: 4,
                            text: 'Bear'
                        }
                    ]
                } */
            }
        }
    },
    created () {
        this.options.selectable.mode = this.selectable
    },
};
</script>

<style>
</style>