<div>
    <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="content-header bg-white-5">
            <!-- Logo -->
            <a class="font-w600 text-dual" href="{{ route('dashboard.index') }}">
                <span class="smini-visible">
                    <i class="fa fa-circle-notch text-primary"></i>
                </span>
                <span class="smini-hide font-size-h5 tracking-wider">
                    {{-- <img src="{{ asset('theme/media/phwc-logo.png') }}" style="width: 80px;" alt=""> --}}
                    {{ env('APP_NAME') }}
                    <small>v{{ env('APP_VERSION') }}</small>
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

                    @foreach ($menus as $menu)
                        @php
                            $menu_url = '#';
                            $menu_dropdown_class = '';
                            if($menu->route_name && Route::has($menu->route_name)) {
                                $menu_url = route($menu->route_name);
                            } else {
                                $menu_url = $menu->menu_url ? url($menu->menu_url) : '#';
                            }

                            if($menu->sub_menus->count() > 0 ) {
                                $menu_url = '#';
                                $menu_dropdown_class = 'nav-main-link-submenu';
                            }
                        @endphp

                        <li class="nav-main-item {{ isset($main_menu) && strtolower($main_menu) == strtolower($menu->title) ? 'open' : '' }}">
                            <a class="nav-main-link {{ $menu_dropdown_class }} {{ ($menu->route_name && request()->routeIs($menu->route_name)) || isset($main_menu) && strtolower($main_menu) == strtolower($menu->title) ? 'active' : '' }}"
                                href="{{ $menu_url }}"
                                data-toggle="{{ $menu->sub_menus->count() > 0 ? 'submenu' : '' }}"
                                aria-haspopup="{{ $menu->sub_menus->count() > 0 ? 'true' : '' }}"
                                aria-expanded="">
                                <i class="nav-main-link-icon si si-{{ $menu->menu_icon }}"></i>
                                <span class="nav-main-link-name">{{ $menu->title }}</span>
                            </a>

                            @if($menu->main_menu)
                                <ul class="nav-main-submenu">
                                    @foreach($menu->sub_menus as $child_menu)
                                    <li class="nav-main-item">
                                        <a class="nav-main-link {{ ($child_menu->route_name && request()->routeIs($child_menu->route_name)) || isset($sub_menu) && strtolower($sub_menu) == strtolower($child_menu->title) ? 'active' : '' }}"
                                            href="{{ $child_menu->route_name && Route::has($child_menu->route_name) ? route($child_menu->route_name) : $child_menu->menu_url }}">
                                            <span class="nav-main-link-name">{{ $child_menu->title }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </nav>
</div>
