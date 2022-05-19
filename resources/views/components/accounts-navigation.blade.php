<div class="card">
    <div class="card-body py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-3 border-y border border-black">
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.finances.index') }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.finances.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Finances</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.expenses.index') }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.expenses.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Debits</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.credits.index') }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.credits.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Credits</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.withdrawals.index') }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.withdrawals.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Withdrawals</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.deposits.index') }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.deposits.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Deposits</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.bills.index') }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.bills.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Bills</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.employee-loan.index') }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.employee-loan.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Employee Loan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
