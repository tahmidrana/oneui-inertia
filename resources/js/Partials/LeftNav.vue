<template>
    <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="content-header bg-white-5">
            <!-- Logo -->
            <a class="font-w600 text-dual" href="#">
                <span class="smini-visible">
                    <i class="fa fa-circle-notch text-primary"></i>
                </span>
                <span class="smini-hide font-size-h5 tracking-wider">
                    <!-- <img src="{{ asset('theme/media/phwc-logo.png') }}" style="width: 80px;" alt=""> -->
                    APP_NAME
                    <small>v1.0</small>
                </span>
            </a>
            <!-- END Logo -->

            <!-- Extra -->
            <div>
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                    <i class="fa fa-fw fa-times"></i>
                </a>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Extra -->
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
            <!-- Side Navigation -->
            <div class="content-side">
                <ul class="nav-main">

                    <li class="nav-main-item">
                        <Link class="nav-main-link"
                            :href="route('dashboard.index')"
                            data-toggle=""
                            aria-haspopup=""
                            aria-expanded="">
                            <i class="nav-main-link-icon si si-speedometer"></i>
                            <span class="nav-main-link-name">Dashboard</span>
                        </Link>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu"
                            href=""
                            data-toggle="submenu"
                            aria-haspopup="true"
                            aria-expanded="">
                            <i class="nav-main-link-icon si si-users"></i>
                            <span class="nav-main-link-name">Users</span>
                        </a>

                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <Link :href="route('users.create')" class="nav-main-link active">
                                    <span class="nav-main-link-name">Add New User</span>
                                </Link>
                            </li>
                            <li class="nav-main-item">
                                <Link :href="route('users.index')" class="nav-main-link active" >
                                    <span class="nav-main-link-name">Manage Users</span>
                                </Link>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
        // Head,
    },
}
</script>
