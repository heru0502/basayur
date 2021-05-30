<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">{{ env('APP_NAME') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">{{ strtoupper(substr(env('APP_NAME'), 0, 2)) }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-columns"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('menus.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.menus.index') }}">
                    <i class="fas fa-newspaper"></i> <span>Menu</span>
                </a>
            </li>
        </ul>
    </aside>

</div>
