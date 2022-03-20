
<div class="card">
    <div class="card-body py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex gap-3 border-y border border-black">
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.index') }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.index') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Overview</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.expenses.index') }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.expenses.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Expenses</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
