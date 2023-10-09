

            <!-- Top Bar Start -->
            <div class="topbar">

                <nav class="navbar-custom">
                    <!-- Search input -->
                    <div class="search-wrap" id="search-wrap">
                        <div class="search-bar">
                            <input class="search-input" type="search" placeholder="Search" />
                            <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                                <i class="mdi mdi-close-circle"></i>
                            </a>
                        </div>
                    </div>

                    <ul class="list-inline float-right mb-0">
                        
                        <!-- Fullscreen -->
                        <li class="list-inline-item dropdown notification-list hidden-xs-down">
                            <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                                <i class="mdi mdi-fullscreen noti-icon"></i>
                            </a>
                        </li>
                        <!-- notification-->
                        {{-- <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-comments noti-icon"></i>
                                <span class="badge badge-danger noti-icon-badge">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5>Disputes (3)</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon "><img src="{{ asset('public/assets/images/hotels/') }}" width="40px" alt="" srcset=""></div>
                                    <p class="notify-details"><b>some title</b><small class="text-muted">some body</small></p>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <p class="notify-details"><b>No Complains</b></p>
                                </a>
                                <!-- All-->
                                <a href="{{url('/getOrderDisputes')}}" class="dropdown-item notify-item">
                                    <center> View All</center>
                                </a>

                            </div>
                        </li> --}}
                        <!-- User-->
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('public/assets/images/noUserImage.jpg') }}" width="150px" alt="" srcset="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <a class="dropdown-item" href="{{ url('profile') }}"><i class="dripicons-user text-muted"></i> Profile</a>
                                
                                <div class="dropdown-divider"></div>
                                <form action="{{ url('logout') }}" method="post">
                                    @csrf
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="fa fa-power-off"></i>
                                        <button type="submit" style="border:none;background:none;"> Logout </button>
                                    </a>
                                </form>
                            </div>
                        </li>
                    </ul>
                <!-- Page title -->
                <ul class="list-inline menu-left mb-0">
                    <li class="list-inline-item">
                        <button type="button" class="button-menu-mobile open-left waves-effect">
                            <i class="ion-navicon"></i>
                        </button>
                    </li>
                    <li class="hide-phone list-inline-item app-search">
                        <h3 class="page-title">@yield('header')</h3>
                    </li>
                </ul>

                <div class="clearfix"></div>
            </nav>
        </div>