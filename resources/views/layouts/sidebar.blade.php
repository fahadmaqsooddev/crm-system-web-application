<?php 
$currentRouteName = Route::currentRouteName();  
$admin = auth()->user();
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">CRM System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">
                    {{ $admin->name ?? 'Admin' }}
                    <br>
                    <small class="text-muted">{{ ucfirst($admin->role ?? 'Admin') }}</small>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                    <li class="nav-item {{ request()->routeIs('leads.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('leads.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Leads <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('leads.index') }}" class="nav-link {{ request()->routeIs('leads.index') ? 'active' : '' }}">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>Leads</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('leads.create') }}" class="nav-link {{ request()->routeIs('leads.create') ? 'active' : '' }}">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>Add Lead</p>
                            </a>
                        </li>
                    </ul>
                </li>
            
                <!-- Logout -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
