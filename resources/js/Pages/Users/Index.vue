<template>
    <BreezeAuthenticatedLayout>
        <Head title="Users" />
        <h1>Manage Users</h1>
        <p>Hello This is users page!</p>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    /* props: {
        user: Object,
    }, */
};
</script>