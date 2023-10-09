
<!DOCTYPE html>
<html lang="en">
  
@include('includes/head')
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet"> -->
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
                    <h5>Property Gallery</h5>
                  </div>
                  <div class="card-body">
                  <form action="{{url('/add_property_gallery')}}" method="POST" >             
                        <div class="row mb-4">
                           <div class="col-md-12">
                              <div class="dropzone mt-4" id="myDropzone" name="docs" >
                                 <div class="dz-message needsclick"></span><i class="fa fa-upload"></i>
                                    <h6>Drop files here or click to upload.</h6></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <center><button type="submit" name="submit" class="btn btn-primary mt-4" id="submit-all"> Add Documents </button></center>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('public/assets/js/script.js')}}"></script>
      <script type="text/javascript">
        setTimeout(function() {
            $('#messages').fadeOut('fast');
        }, 5000);
      </script>
      <script>
      console.log({{$property_id}})
       Dropzone.options.myDropzone= {
        url: "{{route('submit_add_property_gallery')}}",
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 50,
        maxFiles: 50,
        maxFilesize: 50,
        addRemoveLinks: true,
        success: function(file, response){
            Swal.fire({
            position: 'top-end',
            icon: response['type'],
            text: response['msg'],
            showConfirmButton: false,
            timer: 1500,
            width:420
            })
            // console.log(response)
            setTimeout(()=> {
                  window.location.href="{{url('/add_property_doc/'.$property_id)}}";
              }, 1000)

        },
        init: function() {
            dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

            // for Dropzone to process the queue (instead of default form behavior):
            document.getElementById("submit-all").addEventListener("click", function(e) {
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                dzClosure.processQueue();
				
            });
			
            //send all the form data along with the files:
            this.on("sendingmultiple", function(data, xhr, formData) {
              
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("property_id", "{{$property_id}}");
            });
        }
    }
        </script>
        <!-- login js-->
    <!-- Plugin used-->
  </body>

</html>