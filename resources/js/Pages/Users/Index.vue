<template>
    <BreezeAuthenticatedLayout>
        <Head title="Users" />
        <!-- <h3>Manage Users</h3> -->
        <!-- <p>Hello This is users page!</p> -->

        <div class="row">
            <div class="col-sm-12">

                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Manage Users</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option mr-2" data-toggle="modal" data-target="#modal-add">
                                <i class="fa fa-plus mr-1"></i> New User
                            </button>
                            <!-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button> -->
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content block-content-full">
                        <Datatable :columns="columns" selectable="multiple" />
                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from "@inertiajs/inertia-vue3";
import Datatable from '@/Components/Datatable/Index.vue'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Datatable
    },
    data () {
        return {
            columns: ['id', 'name', 'userid', 'last_login', 'action']
        }
    }
};
</script>