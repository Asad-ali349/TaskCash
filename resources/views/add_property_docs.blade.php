
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
            
           <div class="row">
              <div class="col-sm-12 ">
                <div class="card mt-4">
                  <div class="card-header d-flex justify-content-between">
                    <h5>Add Property Document:</h5>
                    <button class="btn btn-primary " type="button" onclick="add_doc_row()"><i class="fa fa-plus" style="color: white;"> Add More Document</i></button>
                  </div>
                  <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/add_property_doc')}}" enctype="multipart/form-data">
                      @csrf
                      <input class="form-control" id="" name="property_id" type="hidden" placeholder="" value="{{$property_id}}" required="required">
                      <div class="row g-3 mb-2">
                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-4">
                                <label class="form-label" for="">Document Name</label>
                                <input class="form-control" id="" name="doc_name[]" type="text" placeholder="Document Name" required="required">
                              </div>
                              <div class="col-md-4">
                              <label class="form-label" for="">Choose Document</label>
                              <input class="form-control" id="" name="doc[]" type="file" placeholder="Dpcument" required="required">
                              </div>
                           </div>
                           <div id="doc_body"></div>
                        </div>
                        
                        <div class="col-md-12 mt-4">
                         <center><button name="submit" class="btn btn-primary mt-4" type="submit" >Add Property</button></center>
                        </div>
                      </div>
                    </form>
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
      <script src="https://use.fontawesome.com/43c99054a6.js"></script>
    
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    
    <script src="{{asset('public/assets/js/script.js')}}"></script>
      <script type="text/javascript">
        setTimeout(function() {
            $('#messages').fadeOut('fast');
        }, 5000);
      </script>
      <script>
			var count=2;
			function add_doc_row(){
			    
			    var additionalhtml='<div class="row mt-4" id="'+count+'">'+
			                            '<div class="col-md-4">'+
                                          '<label class="form-label" for="">Document Name</label>'+
			                                 '<input class="form-control" id="" name="doc_name[]" type="text" placeholder="Document Name" required="required">'+
			                            '</div>'+
			                            '<div class="col-md-4">'+
                                          '<label class="form-label" for="">Choose Document </label>'+
			                                 '<input type="file" class="form-control" name="doc[]" placeholder="Enter Document" >'+
			                            '</div>'+
			                            '<div class="col-md-4">'+
			                                 '<button type="button" class="btn btn-danger" onclick="remove_row('+count+')" style="margin-top:30px"><i class="fa fa-times" style="color: white;" aria-hidden="true"></i></button>'+
			                            '</div>'+
			                        '</div>';
                  
			        $("#doc_body").append(additionalhtml);
                 count+=1
			}
			
			function remove_row(id){
			    $('#'+id).remove();
			}
			
		</script>
    
        
  </body>

</html>