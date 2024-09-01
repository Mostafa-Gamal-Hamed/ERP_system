<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ route("dashboard") }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Storehouse</h3>
        </a>
        <div class="text-center ms-4 mb-4">
            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
            @if (Auth::user()->role === "1")
                <span>Admin</span>
            @else
                <span>User</span>
            @endif
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route("dashboard") }}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

            {{-- Categories --}}
            <div class="nav-item dropdown mb-2">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-list"></i> Categories</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route("category.categories") }}" class="dropdown-item">Categories</a>
                </div>
            </div>

            {{-- Purchases --}}
            <div class="nav-item dropdown mb-2">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-money-bill"></i> Purchases</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route("purchases.purchases") }}" class="dropdown-item">Purchases</a>
                    <a href="{{ route("purchases.add") }}" class="dropdown-item">Add purchase</a>
                </div>
            </div>

            {{-- Sales --}}
            <div class="nav-item dropdown mb-2">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-dollar-sign"></i> Sales</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route("sales.sales") }}" class="dropdown-item">Sales</a>
                    <a href="{{ route("sales.add") }}" class="dropdown-item">Add sales</a>
                </div>
            </div>

            {{-- Warehouse --}}
            <div class="nav-item dropdown mb-2">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-dolly"></i> Warehouse</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route("warehouse.warehouse") }}" class="dropdown-item">warehouse</a>
                    <a href="{{ route("warehouse.add") }}" class="dropdown-item">Add stock</a>
                </div>
            </div>

            {{-- Reports --}}
            <div class="nav-item dropdown mb-2">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-note-sticky"></i> Reports</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route("reports.reports") }}" class="dropdown-item">reports</a>
                    <a href="{{ route("reports.add") }}" class="dropdown-item">Add report</a>
                </div>
            </div>

            {{-- Accounts --}}
            <div class="nav-item dropdown mb-2">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-building-columns"></i> Accounts</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route("accounts.accounts") }}" class="dropdown-item">accounts</a>
                    <a href="{{ route("accounts.add") }}" class="dropdown-item">Add account</a>
                </div>
            </div>

            {{-- Competitions --}}
            <div class="nav-item dropdown mb-2">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-regular fa-hand-back-fist"></i> Competitions</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route("competitions.competitions") }}" class="dropdown-item">competitions</a>
                    <a href="{{ route("competitions.add") }}" class="dropdown-item">Add competition</a>
                </div>
            </div>

            {{-- Tasks --}}
            <div class="nav-item dropdown mb-2">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-regular fa-folder"></i> Tasks</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('tasks.tasks') }}" class="dropdown-item">tasks</a>
                    <a href="{{ route('tasks.add') }}" class="dropdown-item">Add task</a>
                </div>
            </div>

            {{-- Users and Customer --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-users"></i> U and C</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('customer.customers') }}" class="dropdown-item">Customers</a>
                    <a href="{{ route('customer.add') }}" class="dropdown-item">Add customer</a>
                    @if (Auth::user()->role === "1")
                        <a href="{{ route('users.users') }}" class="dropdown-item">Users</a>
                        <a href="{{ route('users.add') }}" class="dropdown-item">Add user</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
