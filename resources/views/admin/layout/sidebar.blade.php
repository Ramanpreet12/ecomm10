<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/images/admin_image/' . Auth::guard('admin')->user()->image) }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link @if (Route::currentRouteName() == 'admin.dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.cms-page.index') }}"
                            class="nav-link @if (Route::currentRouteName() == 'admin.cms-page.index') active @endif">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Cms Page
                                {{-- <span class="right badge badge-danger">New</span> --}}
                            </p>
                        </a>
                    </li>

                @if (Auth::guard('admin')->user()->type == 'admin')
                <li class="nav-item">
                    <a href="{{ route('admin.subadmins.index') }}"
                        class="nav-link @if (Route::currentRouteName() == 'admin.subadmins.index') active @endif">
                        <i class="nav-icon fa-solid fa-user-tie"></i>
                        <p> Subadmins</p>
                    </a>
                </li>
                @endif

                @if (Auth::guard('admin')->user()->type == 'admin')
                    <li class="nav-item @if (Route::currentRouteName() == 'admin.password' || Route::currentRouteName() == 'admin.admin-details') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if (Route::currentRouteName() == 'admin.password' || Route::currentRouteName() == 'admin.admin-details') active @endif">
                            {{-- <i class="nav-icon fas fa-copy"></i> --}}
                            <i class="nav-icon fa-solid fa-gear"></i>
                            <p>
                                Settings
                                <i class="fas fa-angle-left right"></i>
                                {{-- <span class="badge badge-info right">6</span> --}}
                            </p>
                        </a>
                        <ul class="nav nav-treeview @if (Route::currentRouteName() == 'admin.password' || Route::currentRouteName() == 'admin.admin-details') menu-open @endif">
                            <li class="nav-item">
                                <a href="{{ route('admin.password') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'admin.password') active @endif">
                                    {{-- <i class="far fa-circle nav-icon"></i> --}}
                                    <i class="nav-icon fa-solid fa-circle"></i>
                                    <p>Admin Password </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.admin-details') }}"
                                    class="nav-link  @if (Route::currentRouteName() == 'admin.admin-details') active @endif">
                                    <i class="nav-icon fa-solid fa-circle"></i>
                                    <p>Admin Details</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
