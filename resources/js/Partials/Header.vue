<template>
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="d-flex align-items-center">
                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <!-- END Toggle Sidebar -->

                <!-- Toggle Mini Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <!-- END Toggle Mini Sidebar -->

                <!-- Apps Modal -->
                <!-- Opens the Apps modal found at the bottom of the page, after footer’s markup -->
                <button type="button" class="btn btn-sm btn-dual mr-2" data-toggle="modal" data-target="#one-modal-apps">
                    <i class="fa fa-fw fa-cubes"></i>
                </button>
                <!-- END Apps Modal -->

                <!-- Open Search Section (visible on smaller screens) -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-dual d-md-none" data-toggle="layout" data-action="header_search_on">
                    <i class="fa fa-fw fa-search"></i>
                </button>
                <!-- END Open Search Section -->

                <!-- Search Form (visible on larger screens) -->
                <!-- <form class="d-none d-md-inline-block" action="be_pages_generic_search.html" method="POST">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
                        <div class="input-group-append">
                            <span class="input-group-text bg-body border-0">
                                <i class="fa fa-fw fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form> -->
                <!-- END Search Form -->

                <!-- TODO -->
                <div class="ml-2">
                    Using as: Super Admin
                </div>
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="d-flex align-items-center">
                <!-- Notifications Dropdown -->
                <div class="dropdown d-inline-block ml-2">
                    <button type="button" class="btn btn-sm btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="text-primary">•</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-2 bg-primary-dark text-center rounded-top">
                            <h5 class="dropdown-header text-uppercase text-white">Notifications</h5>
                        </div>
                        <!-- TODO -->
                        <ul class="nav-items mb-0">
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-2 ml-3">
                                        <i class="fa fa-fw fa-bell text-success"></i>
                                    </div>
                                    <div class="media-body pr-2">
                                        <div class="font-w600">New user created</div>
                                        <span class="font-w500 text-muted">5 Minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <!-- <p class="text-center mt-3">No new notification</p> -->
                        </ul>

                        <div class="p-2 border-top">
                            <a class="btn btn-sm btn-light btn-block text-center" href="#">
                                <i class="fa fa-fw fa-bell mr-1"></i> View all..
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Notifications Dropdown -->

                <!-- User Dropdown -->
                <div class="dropdown d-inline-block ml-2">
                    <button type="button" class="btn btn-sm btn-dual d-flex align-items-center" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle" src="/theme/media/avatars/avatar10.jpg" alt="Header Avatar" style="width: 21px;">
                        <span class="d-none d-sm-inline-block ml-2">Super Admin</span>
                        <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">
                        <div class="p-3 text-center bg-primary-dark rounded-top">
                            <img class="img-avatar img-avatar48 img-avatar-thumb" src="/theme/media/avatars/avatar10.jpg" alt="">
                            <p class="mt-2 mb-0 text-white font-w500">Super Admin <small>(superadmin)</small></p>
                            <p class="mb-0 text-white-50 font-size-sm">Super Admin</p>
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="">
                                <span class="font-size-sm font-w500">My Profile</span>
                            </a>

                            <button type="button" class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="modal" data-target="#one-modal-apps">
                                <span class="font-size-sm font-w500">Switch Role</span>
                            </button>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="">
                                <span class="font-size-sm font-w500">Change Password</span>
                            </a>
                            <!-- <Link class="block px-6 py-2 w-full text-left hover:text-white hover:bg-indigo-500" href="/logout" method="post" as="button">Logout</Link> -->
                            <Link class="dropdown-item d-flex align-items-center justify-content-between"
                                href="/logout" method="post" as="button"
                                >
                                <span class="font-size-sm font-w500">Log Out</span>

                                <!-- <form method="POST" action="" id="logoutForm">

                                </form> -->
                            </Link>
                        </div>
                    </div>
                </div>
                <!-- END User Dropdown -->

                <!-- Toggle Side Overlay -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <!-- <button type="button" class="btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="side_overlay_toggle">
                    <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>
                </button> -->
                <!-- END Toggle Side Overlay -->
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header bg-white">
            <div class="content-header">
                <form class="w-100" action="be_pages_generic_search.html" method="POST">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
                                <i class="fa fa-fw fa-times-circle"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                    </div>
                </form>
            </div>
        </div>
        <!-- END Header Search -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-white">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->

    </header>

    <!-- Apps Modal -->
    <!-- <x-modal id="one-modal-apps" title="Switch User Role">
        <div class="block-content block-content-full">
            <div class="row gutters-tiny">
                <div class="col-12">
                    <a class="block block-rounded block-link-shadow bg-body d-flex px-3 py-3 border border-success"
                        href="">
                        <div class="mr-3 ml-2">
                            <i class="si si-check text-success"></i>
                        </div>
                        <div class="media-body">
                            <div class="text-success">Super Admin</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </x-modal> -->
    <!-- END Apps Modal -->

</template>

<script>

import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link
    },
}
</script>
