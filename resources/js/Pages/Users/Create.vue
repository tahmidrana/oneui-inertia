<template>
    <BreezeAuthenticatedLayout>
        <Head title="Create New User" />

        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-sm-12">
                <!-- <h2 class="content-heading">Add New User</h2> -->

                <div v-if="errors">{{ errors }}</div>

                <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                    <div class="block block-rounded">
                        <div class="block-header">
                            <h3 class="block-title">Create New User</h3>
                        </div>

                        <div class="block-content block-content-full">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" v-model="form.name" id="name" class="form-control" placeholder="" required />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="userid">User ID *</label>
                                        <input type="text" v-model="form.userid" id="userid" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="gender">Gender *</label>
                                    <select v-model="form.gender" id="gender" class="form-control" required>
                                        <option value="1" >Male</option>
                                        <option value="2" >Female</option>
                                        <option value="3" >Other</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth *</label>
                                        <input type="text" v-model="form.dob" id="dob" class="form-control js-datepicker bg-white bg-white"
                                            autocomplete="off" placeholder="dd-mm-yyyy" required readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address">Address *</label>
                                <input type="text" v-model="form.address" id="address" class="form-control" required/>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone *</label>
                                        <input type="text" v-model="form.phone" id="phone" class="form-control phone" placeholder="01XXXXXXXXX" required />
                                        <small class="helper">11 digit phone no</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" v-model="form.email" id="email" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <h2 class="content-heading border-bottom mb-4 pb-2">HR Info</h2>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="joining_date">Joining Date</label>
                                        <input type="text" v-model="form.joining_date" id="joining_date"
                                            autocomplete="off"
                                            placeholder="dd-mm-yyyy" class="form-control js-datepicker bg-white" readonly />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employment_type">Employment Type *</label>
                                        <select v-model="form.employment_type" id="employment_type" class="form-control" required>
                                            <option value="1">Permanent</option>
                                            <option value="2">Part time</option>
                                            <option value="3">Contractual</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_type_id">User Type *</label>
                                        <select v-model="form.user_type_id" id="user_type_id" class="form-control" required>
                                            <option :value="user_type.id" v-for="user_type in user_types" :key="user_type.id">{{ user_type.title }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="other_roles_id">Other Role</label>
                                        <select name="other_roles_id[]" id="other_roles_id" class="form-control js-select2" multiple>
                                            <option :value="user_type.id" v-for="user_type in user_types" key="user_type.id">{{ user_type.title }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo" class="form-control" />
                                <small>png,jpg,jpeg</small>
                            </div> -->

                            <button type="submit" class="btn btn-success">Submit</button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from "@inertiajs/inertia-vue3";
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        user_types: Array
    },
    setup () {
        const form = reactive({
            name: null,
            userid: null,
            phone: null,
            email: null,
            dob: null,
            gender: null,
            address: null,
            joining_date: null,
            employment_type: null,
            user_type_id: null,
        })

        function handleSubmit () {
            Inertia.post('/users', form)
        }

        return {form, handleSubmit}
    }
};
</script>