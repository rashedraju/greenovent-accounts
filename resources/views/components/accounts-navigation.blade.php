@props(['year', 'month'])

<div class="card">
    <div class="card-body py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex gap-3 border-y">
                    <div class="menu-item me-lg-1">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Expenses
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item py-3 {{ request()->routeIs('accounts.expenses.salary.*') ? 'active' : '' }}"
                                    href="{{ route('accounts.expenses.salary.index', ['year' => $year, 'month' => $month]) }}">Salary
                                    Expenses</a>
                                <a class="dropdown-item py-3" href="#">Daily Conveyances</a>
                            </div>
                        </div>
                        {{-- <a href="#"
                            class="menu-link py-3 {{ request()->routeIs('accounts.expenses.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Expenses</span>
                        </a> --}}
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="#"
                            class="menu-link py-3 {{ request()->routeIs('accounts.credits.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Credits</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="#"
                            class="menu-link py-3 {{ request()->routeIs('accounts.withdrawals.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Withdrawals</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="#"
                            class="menu-link py-3 {{ request()->routeIs('accounts.deposits.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Deposits</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="#"
                            class="menu-link py-3 {{ request()->routeIs('accounts.bills.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Bills</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="#"
                            class="menu-link py-3 {{ request()->routeIs('accounts.requisitions.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Requisitions</span>
                        </a>
                    </div>
                    <div class="menu-item me-lg-1">
                        <a href="#"
                            class="menu-link py-3 {{ request()->routeIs('accounts.employee-loan.*') ? 'bg-primary text-white mx-1' : '' }}">
                            <span class="menu-title">Employee Loan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
