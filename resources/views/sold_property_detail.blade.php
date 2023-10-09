<!DOCTYPE html>
<html lang="en">
	@include('includes/head')
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/photoswipe.css')}}">
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
							<div class="col-md-12">
								<div class="page-title">
									<div class="row">
										<div class="col-6">
											<h3>Sold Property Detail</h3>
										</div>
										<div class="col-6">
											<ol class="breadcrumb">
												<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">                                       
													<i data-feather="home"></i></a>
												</li>
												<li class="breadcrumb-item">Sold Property Detail</li>
											</ol>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card">
									<div class="blog-box blog-list row">
										<div class="col-sm-5"><a href="{{url('property_detail/'.$sold_property->property->id)}}"><img class="img-fluid sm-100-w" src="{{asset('storage/app/'.$sold_property->property->property_image)}}" alt=""></a></div>
										<div class="col-sm-7">
                                            
                                            <div class="blog-details mb-3">
												<div class="blog-date mt-4">Sold Type: {{$sold_property->sold_type}}</div>
												<div class="blog-date">Property Type: {{$sold_property->property->property_type}}</div>
												<h6>Propert Address: {{$sold_property->property->property_address}} </h6>
                                                <hr>
												<div class="mt-4">
													<ul class="blog-socials blog-social">
														<li>Sold Date: <?php
															$d=strtotime($sold_property->sold_date);
															echo date('d-M-Y',$d);
														?></li>
														<li style="padding-right:20px !important">Sold Price: {{$sold_property->sold_amount}}</li><br>
														<li style="border:none !important">Received Price: {{$sold_property->amount_received}}</li>
													</ul>
													<hr>
                                                    <h6>Buyer Info:</h6>
                                                    <p class="mt-0">Name: {{$sold_property->buyer->name}}</p>
                                                    <p class="mt-0">CNIC: {{$sold_property->buyer->cnic}}</p>
                                                    <p class="mt-0">Email: {{$sold_property->buyer->email}}</p>
                                                    <p class="mt-0">Phone: {{$sold_property->buyer->phone}}</p>
                                                    <p class="mt-0">Address: {{$sold_property->buyer->address}}</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="col-sm-12 col-xl-12 ">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true">Due Invoices</a></li>
                                        </ul>
                                        <div class="tab-content" id="top-tabContent">
                                            <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                            <div class="table-responsive">
                                                <table class="hover" id="example-style-5" >
                                                    <thead style="background-color: #E5E5E5">
                                                        <tr>
                                                        <th>Invoice #</th>
                                                        <th>Due Amount</th>
                                                        <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														<?php
															$count=1;
														?>
														@foreach($sold_property->invoices as $invoice)
														@if($invoice->status=='0')
                                                        <tr>
                                                            <td>Invoice {{$count}}</td>
                                                            <td>{{$invoice->due_amount}}</td>
                                                            <td >
                                                                <a class="btn btn-outline-primary btn-xs" onclick="accept_payment({{$invoice->id}},{{$invoice->due_amount}},{{$sold_property->id}})"><i class="fa fa-check"></i></a>
                                                            </td>
                                                        </tr>
														<?php
															$count+=1;
														?>
														@endif
														@endforeach
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xl-12 ">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true">Paid Invoices</a></li>
                                        </ul>
                                        <div class="tab-content" id="top-tabContent">
                                            <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                            <div class="table-responsive">
                                                <table class="hover" id="example-style-51" >
                                                    <thead style="background-color: #E5E5E5">
                                                        <tr>
                                                        <th>Invoice #</th>
                                                        <th>Due Amount</th>
                                                        <th>Paid Amount</th>
                                                        <th>Paid Date</th>
                                                        
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														<?php
															$count=1;
														?>
														@foreach($sold_property->invoices as $invoice)
														@if($invoice->status=='1')
                                                        <tr>
                                                            <td>Invoice {{$count}}</td>
                                                            <td>{{$invoice->due_amount}}</td>
                                                            <td>{{$invoice->received_amount}}</td>
                                                            <td>{{$invoice->paid_date}}</td>
                                                        </tr>
														<?php
															$count+=1;
														?>
														@endif
														@endforeach
                                                    </tbody>
                                                </table>
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
        <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
        <script src="{{asset('public/assets/js/script.js')}}"></script>
        <script src="../assets/js/photoswipe/photoswipe.min.js"></script>
        <script src="../assets/js/photoswipe/photoswipe-ui-default.min.js"></script>
        <script src="../assets/js/photoswipe/photoswipe.js"></script>
        <script src="../assets/js/tooltip-init.js"></script>
		<!-- Plugins JS Ends-->
		<!-- Theme js-->
		<script src="https://use.fontawesome.com/43c99054a6.js"></script>
		<script src="{{asset('public/assets/js/script.js')}}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<script>
			function accept_payment(id,amount,sold_property_id) {
				// console.log(id+'/'+amount+'/'+sold_property_id)
				$.get('/ahmed_property/accept_payment/'+id+'/'+amount+'/'+sold_property_id).then((result)=>{
                    Swal.fire({
                        position: 'top-end',
                        icon: result.type,
                        text: result.msg,
                        showConfirmButton: false,
                        timer: 1500,
                        width:420
                    })
                    setTimeout(()=> {
                        location.reload();
                    }, 1000)
                })
			}
		</script>
	</body>
</html>