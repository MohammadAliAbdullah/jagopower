<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/madmin/dashboard') }}" class="brand-link">
        <img src="{{ asset('public') }}/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">MyCommerce 2</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @if (Auth::guard('madmin')->check())
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('public') }}/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::guard('madmin')->user()->name }}</a>
                </div>
            </div>
        @endif
        <!-- SidebarSearch Form -->
        {{--        <div class="form-inline"> --}}
        {{--            <div class="input-group" data-widget="sidebar-search"> --}}
        {{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search"> --}}
        {{--                <div class="input-group-append"> --}}
        {{--                    <button class="btn btn-sidebar"> --}}
        {{--                        <i class="fas fa-search fa-fw"></i> --}}
        {{--                    </button> --}}
        {{--                </div> --}}
        {{--            </div> --}}
        {{--        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('madmin/dashboard') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{--                <li class="nav-item"> --}}
                {{--                    <a href="pages/widgets.html" class="nav-link"> --}}
                {{--                        <i class="nav-icon fas fa-chart-bar"></i> --}}
                {{--                        <p> --}}
                {{--                            Google Analytics --}}
                {{--                            <span class="right badge badge-danger">New</span> --}}
                {{--                        </p> --}}
                {{--                    </a> --}}
                {{--                </li> --}}
                <?php
                // abdullah add permission
                $loggedInUser = Auth::guard('madmin')->user();
                $roleId = $loggedInUser->role_id;
                
                $query = \App\Models\Menu::where('parent_id', 0);
                
                if ($roleId != 1) {
                    $query->where('id', '!=', 1);
                }
                
                $admenus = $query->orderBy('orders', 'ASC')->get();
                // dd($admenus);
                ?>
                @foreach ($admenus as $admenu)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon {{ $admenu->icon }}"></i>
                            <p>
                                {{ $admenu->name }}
                                <i class="fas fa-angle-left right"></i>
                                {{--                            <span class="badge badge-info right">6</span> --}}
                            </p>
                        </a>
                        <?php
                        $admes = \App\Models\Menu::where('parent_id', $admenu->id)->where('status', 'Active')->get();
                        //dd($admes);
                        ?>

                        <ul class="nav nav-treeview">
                            @foreach ($admes as $subadm)
                                <li class="nav-item">
                                    @if ($subadm->url == '#')
                                        <a href="{{ $subadm->url }}" class="nav-link">
                                        @else
                                            <a href="{{ route($subadm->url) }}" class="nav-link">
                                    @endif
                                    <i class="{{ $subadm->icon }} nav-icon"></i>
                                    <p>{{ $subadm->name }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </li>
                @endforeach
                <li class="nav-item">
                    <a href="{{ route('madmin.tutorial.index') }}" class="nav-link" target="_blank">
                        <i class="nav-icon fa fa-bug"></i>
                        <p>
                            Bug & Update
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('madmin.tutorial.index') }}" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>
                            Tutorial
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('madmin.store.index') }}" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-code"></i>
                        <p>
                            Store(Beta)
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
