@props(['year', 'month'])

<div class="card">
    <div class="card-body py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-3 border-y">
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.expenses.index', ['year' => $year, 'month' => $month]) }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.expenses.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Expenses</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.sales.index', ['year' => $year, 'month' => $month]) }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.sales.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Sales</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.withdrawals.show', ['year' => $year, 'month' => $month]) }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.withdrawals.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Withdrawals</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.deposits.show', ['year' => $year, 'month' => $month]) }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.deposits.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Deposits</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.bills.index', ['year' => $year, 'month' => $month]) }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.bills.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Bills</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.requisitions.index', ['year' => $year, 'month' => $month]) }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.requisitions.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Requisitions</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="{{ route('accounts.employee-loan.index', ['year' => $year, 'month' => $month]) }}"
                            class="menu-link py-3 {{ request()->routeIs('accounts.employee-loan.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Employee Loan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
