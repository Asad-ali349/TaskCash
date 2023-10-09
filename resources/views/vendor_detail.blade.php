<!DOCTYPE html>
<html lang="en">
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
                        <div class="user-profile">
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="page-title">
                                        <div class="row">
                                            <div class="col-6">
                                                <h3>Vendor Detail</h3>
                                            </div>
                                            <div class="col-6">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">                                       
                                                        <i data-feather="home"></i></a>
                                                    </li>
                                                    <li class="breadcrumb-item">View Vendors</li>
                                                    <li class="breadcrumb-item">Vendor Detail</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="card hovercard text-center">
                                        <div class="cardheader"></div>
                                        <div class="user-image">
                                            <div class="avatar"><img alt="" src="{{asset('public/assets/images/user/sample.png')}}"></div>
                                            <div class="icon-wrapper"><a href="{{url('/edit_vendor')}}"><i class="icofont icofont-pencil-alt-5"></i></a></div>
                                        </div>
                                        <div class="info">
                                            <div class="row">
                                                <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                        <div class="ttl-info text-start">
                                                            <h6><i class="fa fa-envelope"></i>   Email</h6><span>{{$vendor->email}}</span>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                        <div class="ttl-info text-start">
                                                            <h6><i class="fa fa-calendar"></i>   Service Type</h6><span>{{$vendor->service_type->name}}</span>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                                    <div class="user-designation">
                                                        <div class="title">{{$vendor->name}}</div>
                                                        <!-- <div class="desc">designer</div> -->
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                        <div class="ttl-info text-start">
                                                            <h6><i class="fa fa-phone"></i>   Contact Number</h6><span>{{$vendor->phone}}</span>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                        <div class="ttl-info text-start">
                                                            <h6><i class="fa fa-location-arrow"></i>   Location</h6><span>{{$vendor->address}}</span>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
		<script src="{{asset('public/assets/js/dashboard/default.js')}}"></script>
		<script src="{{asset('public/assets/js/notify/index.js')}}"></script>
		<script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
		<script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
		<script src="{{asset('public/assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead/handlebars.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead/typeahead.bundle.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead/typeahead.custom.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead-search/handlebars.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead-search/typeahead-custom.js')}}"></script>
		<!-- Plugins JS Ends-->
		<!-- Theme js-->
		<script src="https://use.fontawesome.com/43c99054a6.js"></script>
		<script src="{{asset('public/assets/js/script.js')}}"></script>
	</body>
</html>