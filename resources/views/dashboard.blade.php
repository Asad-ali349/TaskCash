

<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" href="{{asset('public/assets/dash_1.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/dash_2.css')}}">
@include('includes/head')
  <body>
    <div class="loader-wrapper">
      <div class="loader-index"><span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>

    <div class="page-wrapper compact-wrapper" id="pageWrapper">
    @include('includes/topbar')
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        @include('includes/sidebar')
        <div class="page-body">
          <div class="container-fluid">        
            <div class="row ">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                <div class="row widget-statistic">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <div class="widget widget-one_hybrid widget-followers">
                            <div class="widget-heading">
                                <div class="w-title">
                                    <div class="w-icon">
                                    <i data-feather="dollar-sign"></i>
                                    </div>
                                    <div class="">
                                        <p class="w-value">{{$total_sale}}</p>
                                        <h5 class="">Sale</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <div class="widget widget-one_hybrid widget-referral">
                            <div class="widget-heading">
                                <div class="w-title">
                                    <div class="w-icon">
                                    <i data-feather="dollar-sign"></i>
                                    </div>
                                    <div class="">
                                        <p class="w-value">{{$total_purchase}}</p>
                                        <h5 class="">Purchase</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <div class="widget widget-one_hybrid widget-engagement">
                            <div class="widget-heading">
                                <div class="w-title">
                                    <div class="w-icon">
                                    <i data-feather="dollar-sign"></i>
                                    </div>
                                    <div class="">
                                        <p class="w-value">{{$total_expense}}</p>
                                        <h5 class="">Expense</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                <div class="row widget-statistic">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <div class="widget widget-one_hybrid widget-followers">
                            <div class="widget-heading">
                                <div class="w-title">
                                    <div class="w-icon">
                                      <i data-feather="home"></i>
                                    </div>
                                    <div class="">
                                        <p class="w-value">{{$purchase_property_count}}</p>
                                        <h5 class="">Purchase Properties</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <div class="widget widget-one_hybrid widget-referral">
                            <div class="widget-heading">
                                <div class="w-title">
                                    <div class="w-icon">
                                      <i data-feather="home"></i>
                                    </div>
                                    <div class="">
                                        <p class="w-value">{{$sold_property_count}}</p>
                                        <h5 class="">Sold Properties</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                        <div class="widget widget-one_hybrid widget-engagement">
                            <div class="widget-heading">
                                <div class="w-title">
                                    <div class="w-icon">
                                      <i data-feather="users"></i>
                                    </div>
                                    <div class="">
                                        <p class="w-value">{{$vendor_count}}</p>
                                        <h5 class="">Vendors</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-3 mb-4">
                <div class="widget widget-chart-one p-4">
                    <div class="widget-heading">
                        <h5 class="">Monthly Purchase</h5>
                    </div>

                    <div class="widget-content">
                        <div id="revenuePurchaseMonthly"></div>
                    </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-3 mb-4">
                <div class="widget widget-chart-one p-4">
                    <div class="widget-heading">
                        <h5 class="">Monthly Sale</h5>
                    </div>

                    <div class="widget-content">
                        <div id="revenueSaleMonthly"></div>
                    </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-3 mb-4">
                <div class="widget widget-chart-one p-4">
                    <div class="widget-heading">
                        <h5 class="">Yearly Purchase</h5>
                    </div>

                    <div class="widget-content">
                        <div id="revenuePurchaseYearly"></div>
                    </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-3 mb-4">
                <div class="widget widget-chart-one p-4">
                    <div class="widget-heading">
                        <h5 class="">Yearly Sale</h5>
                    </div>

                    <div class="widget-content">
                        <div id="revenueSaleYearly"></div>
                    </div>
                </div>
              </div>
              
            </div>
          </div>
          <!-- Container-fluid starts-->
         
        </div>
        <!-- footer start-->
        @include('includes.footer')
        
      </div>
    </div>
    <!-- latest jquery-->
    <script src="{{asset('public/assets/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('public/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('public/assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('public/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- scrollbar js-->
    <script src="{{asset('public/assets/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{asset('public/assets/js/scrollbar/custom.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('public/assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('public/assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/chartist/chartist.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/knob/knob.min.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/knob/knob-chart.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
    <script src="{{asset('public/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
    <script src="{{asset('public/assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('public/assets/js/notify/index.js')}}"></script>
    <script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
    <script src="{{asset('public/assets/js/typeahead/handlebars.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="https://use.fontawesome.com/43c99054a6.js"></script>
    <script src="{{asset('public/assets/js/script.js')}}"></script>
    <!-- <script src="{{asset('public/assets/dash_1.js')}}"></script> -->
        <!-- login js-->
    <!-- Plugin used-->

   <script src="{{asset('resources/views/includes/revenue_calculation.js')}}"></script>

  </body>

</html>