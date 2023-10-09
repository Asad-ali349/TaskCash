<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
   <div>
      <div class="logo-wrapper" style="padding: 17px 30px !important;">
         <a href="{{url('/dashboard')}}"><img class="img-fluid for-light" src="{{asset('public/assets/images/logo/logo.png')}}" style="width:80%" style="margin-top:-20px !important;" alt=""></a>
         <div class="back-btn"><i class="fa fa-angle-left"></i></div>
         <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      </div>
      <div class="logo-icon-wrapper"><a href="{{asset('public/assets/images/logo/logo.png')}}"><img class="img-fluid" style="width:30px" src="{{asset('public/assets/images/logo/logo-icon2.png')}}" alt=""></a></div>
      <nav class="sidebar-main">
         <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
         <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
               <li class="back-btn">
                  <a href="{{asset('public/assets/images/logo/logo.png')}}"><img class="img-fluid" src="{{asset('public/assets/images/logo/logo-icon2.png')}}" style="width:30px" alt=""></a>
                  <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{url('/dashboard')}}"><i data-feather="home"></i><span class="lan-3">Dashboard</span></a>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"><i data-feather="home"></i><span>Property</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('/add_property')}}">Add Property</a></li>
                     <li><a href="{{url('/view_property')}}">View Property</a></li>
                  </ul>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"><i data-feather="users"></i><span>Vendors</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('/add_vendor')}}">Add Vendor</a></li>
                     <li><a href="{{url('/view_vendor')}}">View Vendors</a></li>
                  </ul>
               </li>
                  <li class="sidebar-list">
                  <a class="sidebar-link " href="{{url('/services')}}"><i data-feather="shopping-bag"></i><span>Services</span></a>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"><i data-feather="dollar-sign"></i><span>Sold Properties</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('/view_fullpayment_properties')}}">Full Payment</a></li>
					      <li><a href="{{url('/view_lease_properties')}}">Lease</a></li>
                  </ul>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"><i data-feather="users"></i><span>Investors</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('/add_investor')}}">Add Investor</a></li>
					      <li><a href="{{url('/view_investors')}}">View Investors</a></li>
                  </ul>
               </li>
            </ul>
         </div>
         <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
   </div>
</div>
<!-- Page Sidebar Ends-->