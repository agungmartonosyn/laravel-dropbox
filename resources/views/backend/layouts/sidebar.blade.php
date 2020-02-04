<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="{{ (request()->is('dropbox*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dropbox.index') }}">
                    <i class="fab fa-dropbox"></i><span>Dropbox</span>
                </a>
            </li>

            <li class="menu-header">Starter</li>

            <li class="dropdown {{ (request()->is('test')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i>
                    <span>Example Active Dropdown</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ (request()->is('tes')) ? 'active' : '' }}">
                        <a class="nav-link" href="index-0.html">General Dashboard</a>
                    </li>
                    <li class="{{ (request()->is('tes')) ? 'active' : '' }}">
                        <a class="nav-link" href="index.html">Ecommerce Dashboard</a>
                    </li>
                </ul>
            </li>
        </ul>

    </aside>
</div>
