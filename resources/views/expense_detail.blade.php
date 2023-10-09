
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
      @include('includes.topbar')
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
      @include('includes.sidebar')
         <div class="page-body">
            <div class="container-fluid">
               <div class="page-title">
                  <div class="row">
                     <div class="col-6">
                        <h3>Expense Detail</h3>
                     </div>
                     <div class="col-6">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">                                       
                              <i data-feather="home"></i></a>
                           </li>
                           <li class="breadcrumb-item">Customers</li>
                           <li class="breadcrumb-item active">Expense Detail</li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="col-sm-12 col-xl-12 xl-100">
                  <div class="card-body">
                     
                     <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <div class="table-responsive">
                                <table class="table table-bordernone">
                                
                                    <tbody>
                                        <tr>
                                        <th class="border-bottom-0">Expense Name:</th>
                                        <td>{{$expense->name}}</td>
                                        </tr>
                                        <tr>
                                        <th class="border-bottom-0" scope="row">Service Type:</th>
                                        <td>{{$expense->vendor->service_type->name}}</td>
                                        </tr>
                                        <tr>
                                        <th class="border-bottom-0" scope="row">Vendor:</th>
                                        <td>{{$expense->vendor->name}}</td>
                                        </tr>
                                        <tr>
                                        <th class="border-bottom-0" scope="row">Expense Date:</th>
                                        <td>{{$expense->expense_date}}</td>
                                        </tr>
                                        <tr>
                                          <th class="border-bottom-0" scope="row">Expense Price:</th>
                                             <td>${{$expense->amount}}</td>
                                          </tr>
                                          <tr>
                                          <th class="border-bottom-0" scope="row">Description:</th>
                                          <td>{{$expense->description}}</td>
                                       </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid Ends-->
            </div>
            <div class="card">
               <div class="col-sm-12">
                  <!-- <div class="card"> -->
                     <div class="card-header">
                        <h6>Add Expense Docs</h6>
                     </div>
                     <div class="card-body">
                        <!-- <form action="{{url('/add_property_gallery')}}" method="POST" > -->
                           <div class="row mb-4">
                              <div class="col-md-12">
                                 <form action="{{url('/add_expense_docs')}}" enctype="multipart/form-data" class="dropzone" id="dropzonewidget">
                                    <div class="dz-message needsclick">
                                       </span><i class="fa fa-upload"></i>
                                       <h6>Drop files here or click to upload.</h6>
                                       </span>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        <!-- </form> -->
                     </div>
                  <!-- </div> -->
               </div>
            </div>
            <div class="card">
               <div class="col-sm-12 col-xl-12 xl-100">
                  <div class="card-body">
                     <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="fa fa-user"></i>Expense Documennt</a></li>
                     </ul>
                     <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                           <div class="table-responsive">
                              <table class="hover" id="example-style-5">
                                 <thead style="background-color: #E5E5E5">
                                    <tr>
                                       <th>Document</th>
                                       <th>Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @if(count($expense->expense_docs)>0)
                                       @foreach($expense->expense_docs as $doc)
                                       <tr>
                                          <td><a href="{{asset('storage/app/'.$doc->document)}}" target="_blank">{{$doc->document}}</a></td>
                                          <td >
                                             <a class="btn btn-outline-primary btn-xs" onclick="delete_expense_doc({{$expense->id}})"><i class="fa fa-trash"></i></a>
                                          </td>
                                       </tr>
                                       @endforeach
                                    @endif
                                 </tbody>
                              </table>
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
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="https://use.fontawesome.com/43c99054a6.js"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
      <script src="{{asset('public/assets/js/script.js')}}"></script>
    <!-- <script src="{{asset('public/assets/js/theme-customizer/customizer.js')}}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <!-- login js-->
      <!-- Plugin used-->
      <script type="text/javascript">
         $(function () {
         $('[data-toggle="tooltip"]').tooltip()
         })
      </script>
      <script>
      function note_form_toggle(x) {
        var xid = document.getElementById(x);
        if (xid.style.display === "none") {
          xid.style.display = "block";
        } else {
          xid.style.display = "none";
        }
      }
      </script>
      <script>
			// var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

			Dropzone.autoDiscover = false;
			var myDropzone = new Dropzone(".dropzone",{ 
					maxFilesize: 20, // 2 mb
					acceptedFiles: ".jpeg,.jpg,.png",
			});
			myDropzone.on("sending", function(file, xhr, formData) {
            console.log("{{$expense->id}}")
					formData.append("_token","{{ csrf_token() }}");
					formData.append("expense_id","{{$expense->id}}");
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
            function delete_expense_doc(id){

               $.get('/ahmed_property/delete_expense_doc/'+id).then((result)=>{
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