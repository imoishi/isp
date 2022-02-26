<aside class="main-sidebar elevation-4 sidebar-light-info">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link navbar-cyan">
        <img src="{{asset('/')}}assets/images/app/logo.png" alt="Starter Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-bold">{{settings('app_name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
    {{--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
    {{--            <div class="image">--}}
    {{--                <img src="{{auth()->user()->avatar}}" class="img-circle elevation-2 " alt="User Image">--}}
    {{--            </div>--}}
    {{--            <div class="info">--}}
    {{--                <a href="{{route('users.profile', auth()->user()->id)}}" class="d-block">{{auth()->user()->full_name}}</a>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('trans.dashboard')
                        </p>
                    </a>
                </li>
{{--                @can('access-category')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('categories.index')}}" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-calendar"></i>--}}
{{--                            <p>--}}
{{--                                Category--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}
                @can('access-role')
                    <li class="nav-item">
                        <a href="{{route('roles.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-key"></i>
                            <p>
                                Role
                            </p>
                        </a>
                    </li>
                @endcan
                @can('access-user')
                    <li class="nav-item">
                        <a href="{{route('users.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                @endcan
                @can('access-customer')
                <li class="nav-item">
                    <a href="{{route('customers.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Customer
                        </p>
                    </a>
                </li>
                @endcan
                @can('access-package')
                <li class="nav-item">
                    <a href="{{route('packages.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Package
                        </p>
                    </a>
                </li>
                @endcan
{{--                @can('access-expense-type')--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('expenseTypes.index')}}" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-paperclip"></i>--}}
{{--                        <p>--}}
{{--                            Expense Type--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endcan--}}

                @can('access-expense')
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Expense
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('access-expense-type')
                        <li class="nav-item">
                            <a href="{{route('expenseTypes.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-paperclip"></i>
                                <p>
                                    Expense Type
                                </p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{route('expenses.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-clipboard"></i>
                                <p>
                                    Manage Expense
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('access-bill')
                    <li class="nav-item">
                        <a href="{{route('bills.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-money-bill-wave-alt"></i>
                            <p>
                                Bill
                            </p>
                        </a>
                    </li>
                @endcan

                @can('access-report')
                    <li class="nav-item">
                        <a href="{{route('reports.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Report
                            </p>
                        </a>
                    </li>
                @endcan

                @can('access-area')
                    <li class="nav-item">
                        <a href="{{route('areas.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-location-arrow"></i>
                            <p>
                                Area
                            </p>
                        </a>
                    </li>
                @endcan

                @can('access-setting')
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            @lang('trans.settings')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a
                                    href="{{route('settings.index')}}"
                                    class="nav-link">
                                    <i class="nav-icon fa fa-cogs"></i>
                                    <p>System Setting</p>
                                </a>
                            </li>
                        @can('access-slider')
                        <li class="nav-item">
                                <a
                                    href="{{route('sliders.index')}}"
                                    class="nav-link">
                                    <i class="nav-icon fa fa-pager"></i>
                                    <p>Slider Setting</p>
                                </a>
                            </li>
                        @endcan
{{--                            <li class="nav-item">--}}
{{--                                <a--}}
{{--                                    href="{{route('divisions.index')}}"--}}
{{--                                    class="nav-link">--}}
{{--                                    <i class="nav-icon fa fa-map"></i>--}}
{{--                                    <p>Division</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a--}}
{{--                                    href="{{route('districts.index')}}"--}}
{{--                                    class="nav-link">--}}
{{--                                    <i class="nav-icon fa fa-map-marker"></i>--}}
{{--                                    <p>District</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a--}}
{{--                                    href="{{route('upazilas.index')}}"--}}
{{--                                    class="nav-link">--}}
{{--                                    <i class="nav-icon fa fa-map-signs"></i>--}}
{{--                                    <p>Upazila</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                    </ul>

                    @endcan
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
