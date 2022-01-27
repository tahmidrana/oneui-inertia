<template>
    <BreezeAuthenticatedLayout>
        <Head title="Welcome" />
        <h1>Welcome</h1>
        <p>Hello Tahmid, welcome to your first Inertia app!</p>
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