<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
            <a href="{{ route('admin-dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item {{ (request()->is('admin/product*')) ? 'active' : '' }}">
            <a href="{{ route('admin-product') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>My Products</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="index.html" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Transactions</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="index.html" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Store Settings</span>
            </a>
        </li>
        {{-- <li class="sidebar-item">
            <a href="index.html" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Shipping Address</span>
            </a>
        </li> --}}
        <li class="sidebar-item">
            <a href="index.html" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>My Account</span>
            </a>
        </li>
        <li class="sidebar-item">
            <div class="divider">
                <div class="divider-text">
                    <a href="/logout">Logout</a>
                </div>
            </div>
        </li>

    </ul>
</div>
