<template>
    <Head title="Log in" />

    <BreezeValidationErrors class="mb-4" />

    <div class="block block-rounded block-themed mb-0">
        <div class="block-header bg-primary-dark">
            <h3 class="block-title">Sign In</h3>
            <div class="block-options">
            </div>
        </div>

        <div class="block-content">

            <div class="p-sm-3 px-lg-4">
                <h1 class="h2 mb-1">APP Name</h1>
                <div class="text-center">
                    <img src="theme/media/phwc-logo.png" alt="" class="">

                    <p class="text-muted">
                        Welcome, please login.
                    </p>
                </div>

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <form class="js-validation-signin" @submit.prevent="submit" method="POST">
                    <div class="py-3">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-alt form-control-lg"
                                id="userid" name="userid" v-model="form.userid" required autofocus autocomplete="userid" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-alt form-control-lg"
                                id="password" name="password" v-model="form.password" required autocomplete="current-password" />
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember"/>
                                <label class="custom-control-label font-w400" for="remember_me">Remember me</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xl-5">
                            <button type="submit" class="btn btn-block btn-alt-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign in
                            </button>
                        </div>
                    </div>
                </form>
                <!-- END Sign In Form -->
            </div>
        </div>
    </div>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                userid: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
