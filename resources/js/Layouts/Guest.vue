<template>
    <div class="page-container">
        <main id="main-container">
            <div class="hero-static">
                <!-- <Link href="/">
                    <BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
                </Link> -->

                <div class="content">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-4">
                            <slot />
                        </div>
                    </div>
                </div>
                <div class="content content-full font-size-sm text-muted text-center">
                    <strong>APP_NAME v1.0</strong> &copy; <span data-toggle="year-copy"></span>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeApplicationLogo,
        Link,
    }
}
</script>
