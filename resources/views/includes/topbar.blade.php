<!-- Page Header Start-->
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <!-- <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form> -->
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="{{url('/dashboard')}}"><img class="img-fluid" src="{{asset('public/assets/images/logo/logo.png')}}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <div class="left-header col horizontal-wrapper ps-0">
           
          </div>
          <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">     
              <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <li class="profile-nav onhover-dropdown p-0 me-0">
                <div class="media profile-media">

                  @if(Auth::guard('admin')->user()->profile_image!='' || Auth::guard('admin')->user()->profile_image!=NULL)
                  <img class="b-r-10" src="{{asset('storage/app/'.Auth::guard('admin')->user()->profile_image)}}" alt="profile_imag" style="width:40px; height:40px">
                  @else
                  <img class="b-r-10" src="{{asset('public/assets/images/user/sample.png')}}" style="width:40px;height:40px;" alt="profile_imag">
                  @endif
                  <div class="media-body"><span>{{Auth::guard('admin')->user()->name}}</span>
                    <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div" style="margin-top:-10px !important">
                  <li><a href="{{url('/profile')}}"><i data-feather="user"></i><span>Profile </span></a></li>
                  <li><a href="{{url('/change_password')}}"><i data-feather="settings"></i><span>Password</span></a></li>
                  <li>
                    <form action="{{url('/logout')}}" method="POST" id="logout-form">
                      @csrf
                      <a onclick="logout()"><i data-feather="log-in"></i>Logout</a>
                    </form>
                    <script>
                        function logout() {
                          $('#logout-form').submit()
                        }
                    </script>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
         
        </div>
      </div>
      <!-- Page Header Ends-->