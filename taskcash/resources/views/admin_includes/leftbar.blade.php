
        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="">
                        <!--<a href="index" class="logo text-center">Fonik</a>-->
                        <a href="{{ url('dashboard') }}" class="logo"><img src="{{ asset('public/assets/images/taskcash.png') }}" height="150" alt="logo"></a>
                    </div>
                </div>
<hr>
                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>

                            <li>
                                <a href="{{ url('dashboard') }}" class="waves-effect"><i class="fa fa-tachometer"></i><span> Dashboard </span></a>
                            </li>

                            {{-- Businesses --}}
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-home"></i>
                                    <span> Businesses 
                                        <span class="badge badge-heading badge-info new_res p-1 ml-4"></span>
                                        <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> 
                                    </span>
                                </a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{ url('businesses') }}"><i class="fa fa-check text-success"></i>All Businesses
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('business/create') }}"><i class="fa fa-exclamation-circle text-info"></i>Add New
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- Users --}}
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-home"></i>
                                    <span> Users 
                                        <span class="badge badge-heading badge-info new_res p-1 ml-4"></span>
                                        <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> 
                                    </span>
                                </a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{ url('users') }}"><i class="fa fa-check text-success"></i>All Users
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- Tasks --}}
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-home"></i>
                                    <span> Tasks 
                                        <span class="badge badge-heading badge-info new_res p-1 ml-4"></span>
                                        <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> 
                                    </span>
                                </a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{ url('approved-tasks') }}"><i class="fa fa-check text-success"></i>Approved Tasks
                                            {{-- <span class="badge badge-heading badge-success float-right active_res">0</span> --}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('completed-tasks') }}"><i class="fa fa-exclamation-circle text-info"></i>Completed Tasks
                                            
                                            {{-- <span class="badge badge-heading badge-info float-right new_res">0</span> --}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('unapproved-tasks') }}"><i class="fa fa-times text-danger"></i>Unapproved Tasks
                                            {{-- <span class="badge badge-heading badge-danger float-right disable_res">0</span> --}}
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- Category --}}
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-home"></i>
                                    <span> Categories
                                        <span class="badge badge-heading badge-info new_res p-1 ml-4"></span>
                                        <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> 
                                    </span>
                                </a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{ url('categories') }}"><i class="fa fa-bars text-success"></i>View All
                                            {{-- <span class="badge badge-heading badge-success float-right active_res">0</span> --}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('categories.create') }}"><i class="fa fa-plus text-primary"></i>Add New
                                            {{-- <span class="badge badge-heading badge-success float-right active_res">0</span> --}}
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- Activities --}}
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-home"></i>
                                    <span> Activities
                                        <span class="badge badge-heading badge-info new_res p-1 ml-4"></span>
                                        <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> 
                                    </span>
                                </a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{ url('activities') }}"><i class="fa fa-bars text-success"></i>View All
                                            {{-- <span class="badge badge-heading badge-success float-right active_res">0</span> --}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('activities.create') }}"><i class="fa fa-plus text-primary"></i>Add New
                                            {{-- <span class="badge badge-heading badge-success float-right active_res">0</span> --}}
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{--  --}}
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-suitcase"></i><span> Disputes
                                     <span class="badge badge-heading badge-danger unResolvedDisputes p-1 ml-4"></span>
                                     <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{url('/unresolved-disputes')}}">Unresolved Disputes </a>
                                    </li>
                                    <li>
                                        <a href="{{url('/resolved-disputes')}}">Resolved Disputes</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->