<div>
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
                {{-- <form class="d-none d-md-inline-block" action="be_pages_generic_search.html" method="POST">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
                        <div class="input-group-append">
                            <span class="input-group-text bg-body border-0">
                                <i class="fa fa-fw fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form> --}}
                <!-- END Search Form -->

                <div class="ml-2">
                    Using as: {{ auth()->user()->is_superuser ? 'Super Admin' : (session()->has('role') ? session('role')->title : '') }}
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
                        <ul class="nav-items mb-0">
                            @forelse($myNotifications as $notif)
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-2 ml-3">
                                        <i class="fa fa-fw fa-bell text-success"></i>
                                    </div>
                                    <div class="media-body pr-2">
                                        <div class="font-w600">{{ $notif->data['text'] }}</div>
                                        <span class="font-w500 text-muted">{{ $notif->created_at->diffForHumans() }}</span>
                                    </div>
                                </a>
                            </li>
                            @empty
                                <p class="text-center mt-3">No new notification</p>
                            @endforelse
                        </ul>

                        <div class="p-2 border-top">
                            <a class="btn btn-sm btn-light btn-block text-center" href="{{ route('notification-center.index') }}">
                                <i class="fa fa-fw fa-bell mr-1"></i> View all..
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Notifications Dropdown -->

                <!-- User Dropdown -->
                <div class="dropdown d-inline-block ml-2">
                    <button type="button" class="btn btn-sm btn-dual d-flex align-items-center" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle" src="{{ asset('theme/media/avatars/avatar10.jpg') }}" alt="Header Avatar" style="width: 21px;">
                        <span class="d-none d-sm-inline-block ml-2">{{ auth()->user()->name }}</span>
                        <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">
                        <div class="p-3 text-center bg-primary-dark rounded-top">
                            <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('theme/media/avatars/avatar10.jpg') }}" alt="">
                            <p class="mt-2 mb-0 text-white font-w500">{{ auth()->user()->name }} <small>({{ auth()->user()->userid }})</small></p>
                            <p class="mb-0 text-white-50 font-size-sm">{{ session('role') ? session('role')->title : (auth()->user()->is_superuser ? 'Super Admin' : '') }}</p>
                            <p class="mb-0 text-white-50 font-size-sm">{{ auth()->user()->clinician_type ? auth()->user()->clinician_type_text : '' }}</p>
                        </div>
                        <div class="p-2">
                            @if(session()->has('role') && session('role')->slug == 'clinician')
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('clinicians.show', ['id' => auth()->id()]) }}">
                                <span class="font-size-sm font-w500">My Profile</span>
                            </a>
                            @endif

                            <button type="button" class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="modal" data-target="#one-modal-apps">
                                <span class="font-size-sm font-w500">Switch Role</span>
                            </button>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('password-change.index') }}">
                                <span class="font-size-sm font-w500">Change Password</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                                <span class="font-size-sm font-w500">Log Out</span>

                                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END User Dropdown -->

                <!-- Toggle Side Overlay -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                {{-- <button type="button" class="btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="side_overlay_toggle">
                    <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>
                </button> --}}
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
    <x-modal id="one-modal-apps" title="Switch User Role">
        <div class="block-content block-content-full">
            <div class="row gutters-tiny">
                <div class="col-12">
                    @foreach ($userRoles as $userRole)
                    <!-- CRM -->
                    <a class="block block-rounded block-link-shadow bg-body d-flex px-3 py-3 {{ $userRole->id == session('role_id') ? 'border border-success' : '' }} "
                        href="{{ route('set-user-type', ['user_type' => $userRole->id]) }}">
                        <div class="mr-3 ml-2">
                            <i class="si si-{{ $userRole->id == session('role_id') ? 'check' : '' }} text-{{ $userRole->id == session('role_id') ? 'success' : '' }}"></i>
                        </div>
                        <div class="media-body">
                            <div class="text-{{ $userRole->id == session('role_id') ? 'success' : '' }}">{{ $userRole->title }}</div>
                        </div>
                    </a>
                    <!-- END CRM -->
                    @endforeach
                </div>
            </div>
        </div>
    </x-modal>
    <!-- END Apps Modal -->
</div>
