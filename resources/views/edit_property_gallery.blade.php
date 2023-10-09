<!DOCTYPE html>
<html lang="en">
	@include('includes/head')
	
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/datatables.css')}}">
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
						<div class="row">
							<div class="col-sm-12 mt-5">
								<div class="card">
									<div class="card-header">
										<h5>Edit Property Gallery</h5>
									</div>
									<div class="card-body">
										<!-- <form action="{{url('/add_property_gallery')}}" method="POST" > -->
											<div class="row mb-4">
												<div class="col-md-12">
													<form action="{{url('/edit_property_gallery')}}" enctype="multipart/form-data" class="dropzone" id="dropzonewidget">
														<div class="dz-message needsclick">
															</span><i class="fa fa-upload"></i>
															<h6>Drop files here or click to upload.</h6>
															</span>
														</div>
													</form>
												</div>
											</div>
											<center><a type="button"  class="btn btn-primary mt-4" href="{{url('edit_property_doc/'.$property_id)}}"> Add Documents </a></center>
										<!-- </form> -->
									</div>
								</div>
							</div>
							<div class="col-sm-12 mt-5">
								<div class="card">
									<div class="card-header">
										<h5>Property Gallery</h5>
									</div>
									<div class="card-body">
                                    <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                        <div class="table-responsive">
                                            <table class="hover" id="example-style-5">
                                                <thead style="background-color: #E5E5E5">
                                                    <tr>
                                                    <th>Gallery Image</th>
                                                    <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($property_gallery as $gallery)
                                                    <tr>
                                                        <td><a target="_blank" href="{{asset('storage/app/'.$gallery->property_image)}}">{{$gallery->property_image}}</a></td>
                                                        <td >
                                                            
                                                            <a class="btn btn-outline-primary btn-xs" onclick="delete_gallery('{{$gallery->id}}')"><i class="fa fa-trash"></i></a>
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
					</div>
				</div>
				<!-- Container-fluid Ends-->
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
		<script src="{{asset('public/assets/js/notify/bootstrap-notify.min.js')}}"></script>
		<script src="{{asset('public/assets/js/dashboard/default.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead-search/handlebars.js')}}"></script>
		<script src="{{asset('public/assets/js/typeahead-search/typeahead-custom.js')}}"></script>
		<script src="{{asset('public/assets/js/form-validation-custom.js')}}"></script>
        <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
		<script src="https://use.fontawesome.com/43c99054a6.js"></script>
		<!-- Plugins JS Ends-->
		<!-- Theme js-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="{{asset('public/assets/js/script.js')}}"></script>
		<script type="text/javascript">
			setTimeout(function() {
			    $('#messages').fadeOut('fast');
			}, 5000);
		</script>


		<script>
			// var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

			Dropzone.autoDiscover = false;
			var myDropzone = new Dropzone(".dropzone",{ 
					maxFilesize: 20, // 2 mb
					acceptedFiles: ".jpeg,.jpg,.png",
			});
			myDropzone.on("sending", function(file, xhr, formData) {
					formData.append("_token","{{ csrf_token() }}");
					formData.append("property_id","{{$property_id}}");
			}); 
			myDropzone.on("success", function(file, response) {

					
				Swal.fire({
					position: 'top-end',
					icon: response.type,
					title: response.msg,
					showConfirmButton: false,
					timer: 1500,
					width:420
				})
				setTimeout(()=> {
					location.reload();
				}, 1000)
					

			});
       </script>
        <script>
		function delete_gallery(id){

			$.get('/ahmed_property/delete_gallery/'+id).then((result)=>{
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
		<!-- login js-->
		<!-- Plugin used-->
	</body>
</html>