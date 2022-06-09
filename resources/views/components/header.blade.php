@php
$user = auth()->user();
@endphp

<div id="kt_header" style="" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header menu toggle-->
        <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                id="kt_header_menu_mobile_toggle">
                <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                            fill="black" />
                        <path opacity="0.3"
                            d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                            fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!--end::Header menu toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ url('/') }}" class="">
                <img alt="Logo" src="{{ asset('/public/assets/media/logos/greenovent.png') }}"
                    style="height: 96px;" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <!--begin::Menu wrapper-->
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
                    data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                    data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    <!--begin::Menu-->
                    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                        id="#kt_header_menu" data-kt-menu="true">

                        <div class="menu-item me-lg-1">
                            <a href="{{ route('dashboard') }}"
                                class="menu-link py-3 {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>
                        <div class="menu-item me-lg-1">
                            <a href="{{ route('clients.index') }}"
                                class="menu-link py-3 {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                                <span class="menu-title">Clients</span>
                            </a>
                        </div>
                        <div class="menu-item me-lg-1">
                            <a href="{{ route('projects.index') }}"
                                class="menu-link py-3 {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                                <span class="menu-title">Account Manager</span>
                            </a>
                        </div>

                        <div class="menu-item me-lg-1">
                            <a href="{{ route('accounts.index') }}"
                                class="menu-link py-3 {{ request()->routeIs('accounts.*') ? 'active' : '' }}">
                                <span class="menu-title">Accounts</span>
                            </a>
                        </div>

                        <div class="menu-item me-lg-1">
                            <a href="{{ route('employees.index') }}"
                                class="menu-link py-3 {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                                <span class="menu-title">Employees</span>
                            </a>
                        </div>

                        <div class="menu-item me-lg-1">
                            <a href="{{ route('permissions.index') }}"
                                class="menu-link py-3 {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                                <span class="menu-title">Permissions</span>
                            </a>
                        </div>
                        <div class="menu-item me-lg-1">
                            <a href="{{ route('approvals.index') }}"
                                class="menu-link py-3 {{ request()->routeIs('approvals.*') ? 'active' : '' }}">
                                <span class="menu-title">Approvals</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Menu wrapper-->
            </div>
            <!--end::Navbar-->
            @if (auth()->check())
                <!--begin::Toolbar wrapper-->
                <div class="d-flex align-items-stretch flex-shrink-0">
                    <!--begin::User menu-->
                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                        <!--begin::Menu wrapper-->
                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click"
                            data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            @if ($profileImg = auth()->user()->profile_image)
                                <img src="{{ asset("/public/uploads/{$profileImg}") }}" alt="" srcset=""
                                    class="symbol-label fs-3 bg-light-danger text-danger border border-secondary">
                            @else
                                <div class="symbol-label fs-3 bg-light-danger text-danger border border-secondary">
                                    {{ ucfirst(substr(auth()->user()->name, 0, 1)) }} </div>
                            @endif
                        </div>
                        <!--begin::User account menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                        @if ($profileImg = auth()->user()->profile_image)
                                            <img src="{{ asset("/public/uploads/{$profileImg}") }}" alt="" srcset=""
                                                class="symbol-label fs-3 bg-light-danger text-danger border border-secondary">
                                        @else
                                            <div
                                                class="symbol-label fs-3 bg-light-danger text-danger border border-secondary">
                                                {{ ucfirst(substr(auth()->user()->name, 0, 1)) }} </div>
                                        @endif
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bolder d-flex align-items-center fs-5">
                                            {{ ucfirst(auth()->user()->name) }}
                                        </div>
                                        <div class="fw-bold text-muted text-hover-primary fs-7">
                                            {{ auth()->user()->designation() }}</div>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="{{ route('employees.show', auth()->user()) }}" class="menu-link px-5">My
                                    Profile</a>
                            </div>

                            <div class="menu-item px-5">
                                <a href="{{ route('leave.create') }}" class="menu-link px-5">
                                    Leave Register
                                </a>
                            </div>

                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="{{ route('logout') }}" class="menu-link px-5">Sign Out</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->

                        </div>
                        <!--end::User account menu-->
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::User menu-->
                </div>
                <!--end::Toolbar wrapper-->
            @else
                <div class="d-flex align-items-center">
                    <a href="{{ route('login') }}" class="py-3">Login</a>
                </div>
            @endif
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
