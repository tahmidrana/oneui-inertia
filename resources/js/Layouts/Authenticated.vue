<template>
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
        <!-- Sidebar -->
        <LeftNav />
        <!-- END Sidebar -->

        <!-- Header -->
        <Header />
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            <!-- Hero -->
            <!-- @yield('breadcrumb') -->
            <!-- END Hero -->

            <!-- Page Content -->
            <div class="content">
                <slot />
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="bg-body-light">
            <div class="content py-3">
                <div class="row font-size-sm">
                    <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                        Developed <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="https://appinionbd.com" target="_blank">Appinion BD Ltd</a>
                    </div>
                    <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
                        <a class="font-w600" href="#" target="_blank">APP_NAME</a> &copy; <span data-toggle="year-copy"></span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/inertia-vue3';
import LeftNav from '@/Partials/LeftNav.vue'
import Header from '@/Partials/Header.vue'

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
        LeftNav,
        Header,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        }
    },
}
</script>
