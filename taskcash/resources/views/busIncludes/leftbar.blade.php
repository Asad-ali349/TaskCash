
        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="">
                        <!--<a href="index" class="logo text-center">Fonik</a>-->
                        <a href="{{ url('business-dashboard') }}" class="logo"><img src="{{ asset('public/assets/images/taskcash.png') }}" height="150" alt="logo"></a>
                    </div>
                </div>
<hr>
                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>

                            <li>
                                <a href="{{ url('business-dashboard') }}" class="waves-effect"><i class="fa fa-tachometer"></i><span> Dashboard </span></a>
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
                                        <a href="{{ url('tasks') }}"><i class="fa fa-bars text-info"></i>All Tasks
                                            {{-- <span class="badge badge-heading badge-success float-right active_res">0</span> --}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('tasks/create') }}"><i class="fa fa-plus text-primary"></i>Add New Task
                                            {{-- <span class="badge badge-heading badge-danger float-right disable_res">0</span> --}}
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- transactions --}}
                            <li>
                                <a href="{{ url('transactions') }}" ><i class="dripicons-suitcase"></i><span> Transactions 
                                    <span class="badge badge-heading badge-danger unResolvedDisputes p-1 ml-4"></span>
                                    <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span>
                                </a>
                            </li>

                             {{-- disputes --}}
                             <li>
                                <a href="{{ url('disputes') }}" ><i class="dripicons-suitcase"></i><span> Disputes 
                                    <span class="badge badge-heading badge-danger p-1 ml-4"></span>
                                    <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->