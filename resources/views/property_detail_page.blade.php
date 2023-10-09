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
											<h3>Property Detail</h3>
										</div>
										<div class="col-6">
											<ol class="breadcrumb">
												<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">                                       
													<i data-feather="home"></i></a>
												</li>
												<li class="breadcrumb-item">View Property</li>
												<li class="breadcrumb-item">Property Detail</li>
											</ol>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card">
									<div class="blog-box blog-list row">
										<div class="col-sm-5"><center><img class="img-fluid sm-100-w" src="{{asset('storage/app/'.$property->property_image)}}" alt=""></center></div>
										<div class="col-sm-7">
                                            
                                            <div class="blog-details p-4">
                                                
												<!-- <div class="blog-date">Purchased Date:&nbsp;&nbsp;&nbsp;<span>05</span> January 2019</div> -->
                                                
												<div class="blog-date">Property Type: {{$property->property_type}}</div>
												<h6>Propert Address: {{$property->property_address}} </h6>
												<div class="mt-4">
													<ul class="blog-socials blog-social">
														<li>Marlas: {{$property->num_of_marla}}</li>
														<li style="padding-right:20px">Sq. Feet per marla: {{$property->sq_feet}}</li>
														<li style="border:none !important">
                                                            Total Sq. Feet: 
                                                            
                                                            <?php
                                                                $total_sqfeet=(int)$property->sq_feet * (int)$property->num_of_marla;
                                                                echo $total_sqfeet;
                                                            ?>
                                                        </li>
														<hr>
														<li>
                                                            Purchase Price per Sq. Feet: <?php $total_sqfeet=(int)$property->sq_feet * (int)$property->num_of_marla; $purchase_price_per_sqfeet= (float)$property->purchased_amount /$total_sqfeet ; echo $purchase_price_per_sqfeet ?>
                                                            
                                                        </li>
														<li style="border:none !important">Total Purchase Price: {{$property->purchased_amount}}</li>
													</ul>
													<hr>
                                                    @if($property->status=='0')
                                                <a href="{{url('/sell_property/'.$property->id)}}" type="button" class="btn btn-outline-info mt-3 mb-3">Sell</a>
                                                @endif
													<!-- <p class="mt-0"><span><b>Description:</b> </span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, debitis, est laborum fugiat doloribus quae harum vel tempora eius aliquam dolor minima beatae error nihil pariatur magnam, aperiam a quis.</p> -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="col-sm-12">
                                <div class="card">
                                <div class="card-header">
                                    <h5>Property Gallery</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row my-gallery gallery" id="aniimated-thumbnials" itemscope="">

                                    @foreach($property->gallery as $gallery)
                                    <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope=""><a href="{{asset('storage/app/'.$gallery->property_image)}}" itemprop="contentUrl" data-size="1600x950">
                                        <div><img src="{{asset('storage/app/'.$gallery->property_image)}}" itemprop="thumbnail" alt="Image description" style="height:200px"></div></a>
                                        
                                    </figure>
                                    @endforeach
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xl-12 ">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="fa fa-file"></i>Property Docs</a></li>
                                        </ul>
                                        <div class="tab-content" id="top-tabContent">
                                            <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                            <div class="table-responsive">
                                                <table class="hover" id="example-style-5" >
                                                    <thead style="background-color: #E5E5E5">
                                                        <tr>
                                                        <th>Document Name</th>
                                                        <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($property->docs as $doc)
                                                        <tr>
                                                            <td><a href="{{asset('storage/app/'.$doc->document)}}">{{$doc->doc_name}}</a></td>
                                                            <td >
                                                                <a class="btn btn-outline-primary btn-xs" onclick="delete_doc({{$doc->id}})"><i class="fa fa-trash"></i></a>
                                                            </td>
                                                        </tr>
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
                                            <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="fa fa-file"></i>Property Investors</a></li>
                                        </ul>
                                        <div class="tab-content" id="top-tabContent">
                                            <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                            <div class="table-responsive">
                                                <table class="hover" id="example-style-52" >
                                                    <thead style="background-color: #E5E5E5">
                                                        <tr>
                                                        <th>Investor Name</th>
                                                        <th>Investment Amount (Rs)</th>
                                                        <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($property->investment as $investment)
                                                        <tr>
                                                            <td>{{$investment->investor->name}}</td>
                                                            <td>{{$investment->investment_amount}}</td>
                                                            <td >
                                                                <a class="btn btn-outline-primary btn-xs" onclick="delete_investment({{$investment->id}})"><i class="fa fa-trash"></i></a>
                                                            </td>
                                                        </tr>
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
                                            <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="fa fa-file"></i>Property Expenses</a></li>
                                        </ul>
                                        <div class="tab-content" id="top-tabContent">
                                            <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                                <div class="table-responsive">
                                                    <table class="hover" id="example-style-51" >
                                                        <thead style="background-color: #E5E5E5">
                                                            <tr>
                                                            <th>Expense Name</th>
                                                            <th>Vendor Name</th>
                                                            <th>Expense Amount (Rs)</th>
                                                            <th>Expense Date</th>
                                                            <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $total_expense=0.0;
                                                            ?>
                                                            @if(count($property->expense)>0)
                                                                @foreach($property->expense as $expense)
                                                                <tr>
                                                                    <td>{{$expense->name}}</td>
                                                                    <td>{{$expense->vendor->name}}</td>
                                                                    <td>{{$expense->amount}}</td>
                                                                    <td>{{$expense->expense_date}}</td>
                                                                    <td >
                                                                        <a class="btn btn-outline-primary btn-xs" href="{{url('/expense_detail/'.$expense->id)}}"><i class="fa fa-list"></i></a>
                                                                        <a class="btn btn-outline-primary btn-xs" href="{{url('/edit_expense/'.$expense->id)}}"><i class="fa fa-edit"></i></a>
                                                                        <a class="btn btn-outline-primary btn-xs" href="#"><i class="fa fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                    $total_expense+=(float)$expense->amount;
                                                                ?>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end mt-5">
                                                    <div class="table-responsive">
                                                        <h6>Lump Sum Peport</h6>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                <th scope="col">Item</th>
                                                                <th scope="col">Price (Rs)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Total Expense</td>
                                                                    <td>{{$total_expense}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Purchase Price</td>
                                                                    <td>{{$property->purchased_amount}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Purchase Price Per Square Feet</td>
                                                                    <td>{{$purchase_price_per_sqfeet}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Purchase Price After Expense</td>
                                                                    <td>
                                                                        <?php
                                                                           $purchase_price_after_expense= (float)$property->purchased_amount+$total_expense;
                                                                           echo $purchase_price_after_expense;
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Purchase Price Per Square Feet After Expense</td>
                                                                    <td>{{$purchase_price_after_expense/$total_sqfeet}}</td>
                                                                </tr>
                                                                
                                                                
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
        <script src="{{asset('public/assets/js/photoswipe/photoswipe.min.js')}}"></script>
        <script src="{{asset('public/assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
        <script src="{{asset('public/assets/js/photoswipe/photoswipe.js')}}"></script>
        <script src="{{asset('public/assets/js/tooltip-init.js')}}"></script>
		<!-- Plugins JS Ends-->
		<!-- Theme js-->
		<script src="https://use.fontawesome.com/43c99054a6.js"></script>
		<script src="{{asset('public/assets/js/script.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function delete_doc(id){

                $.get('/ahmed_property/delete_doc/'+id).then((result)=>{
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
            function delete_investment(id){

                $.get('/ahmed_property/delete_investment/'+id).then((result)=>{
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