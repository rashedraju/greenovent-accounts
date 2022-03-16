<div class="menu menu-lg-rounded menu-row menu-md-column menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
    id="#kt_header_menu" data-kt-menu="true">
    <div class="menu-item me-lg-1">
        <a href="{{ route('accounts.daily_conveyance.index') }}"
            class="menu-link py-3 {{ request()->routeIs('accounts.daily_conveyance.index') ? 'active' : '' }}">
            <span class="menu-title">Daily Conveyance</span>
        </a>
    </div>
</div>
