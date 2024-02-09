        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('profile.index', auth()->user()) }}" class="brand-link">
                <img src="{{ asset('dist/img/logo-img-white.svg') }}" alt="IMG" class="" style="opacity: 0.8" />
                <!-- <span class="brand-text font-weight-light">AdminLTE 3</span> -->
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ auth()->user()->avatar() }}" class="img-circle elevation-2" alt="User Image" />
                    </div>
                    <div class="info">
                        <a href="{{ route('profile.index', auth()->user()) }}"
                            class="d-block">{{ auth()->user()->slug }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search" />
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
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('admin.traffic', $year) }}"
                                class="nav-link {{ Route::is('admin.traffic') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Traffic</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user') }}"
                                class="nav-link {{ Route::is('admin.user') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.image') }}"
                                class="nav-link {{ Route::is('admin.image') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-database"></i>
                                <p>Data Image</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
