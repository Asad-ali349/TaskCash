
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
                  <div class="card-header">
                    <h5>Add Property Expense:</h5>
                    <p>Property Address: Satelite Town, Gujranwala</p>
                  </div>
                  <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/add_expense_without_File')}}" id="expense_form">
                      @csrf
                      <input class="form-control" value="{{$property_id}}" id="property_id" name="property_id" type="hidden" placeholder="Property Id" required="required">
                      <div class="row g-3 mb-2">
                        <div class="col-md-4">
                          <label class="form-label" for="">Expense Name</label>
                          <input class="form-control" id="expense_name" name="expense_name" type="text" placeholder="Expense Name" required="required">
                          
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="">Vendor</label>
                          <select class="form-control js-example-basic-single col-sm-12" name="vendor_id" id="vendor_id" required="required">
                              <option value="">Select Vendor</option>
                              @foreach($vendors as $vendor)
                              <option value="{{$vendor->id}}">{{$vendor->name.' ['.$vendor->service_type->name.']'}}</option>
                              @endforeach
                            
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="">Expense Amount</label>
                          <input class="form-control" id="expense_amount" name="expense_amount" type="text" placeholder="Expense Amount" required="required">
                          
                        </div>
                        
                        
                        <div class="col-md-12">
                          <label class="form-label" for="">Description</label>
                          <textarea rows="5" class="form-control" id="description" name="description" type="text" placeholder="Description (optional)"></textarea>
                        </div>
                        <div class="col-md-12">
                          <label class="form-label" for="">Expense Docs</label>
                          <div class="dropzone mt-4" id="myDropzone" name="doc" >
                            <div class="dz-message needsclick"></span><i class="fa fa-upload"></i>
                                <h6>Drop files here or click to upload.</h6></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="">Expense Date</label>
                          <input class="form-control" id="expense_date" name="expense_date" type="date" placeholder="Expense Date" required="required">
                        </div>
                        <div class="col-md-12 mt-4">
                          <center><input name="" class="btn btn-primary mt-4" type="button" value="Add Expense" id="submit-all"></center>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script src="{{asset('public/assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('public/assets/js/dashboard/default.js')}}"></script>
 
    <script src="{{asset('public/assets/js/typeahead-search/handlebars.js')}}"></script>
    <script src="{{asset('public/assets/js/typeahead-search/typeahead-custom.js')}}"></script>
    <script src="{{asset('public/assets/js/form-validation-custom.js')}}"></script>
      <script src="https://use.fontawesome.com/43c99054a6.js"></script>
    
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    
    <script src="{{asset('public/assets/js/script.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script type="text/javascript">
        setTimeout(function() {
            $('#messages').fadeOut('fast');
        }, 5000);
      </script>
      <script>
       Dropzone.options.myDropzone= {
        url: "{{url('/add_expense')}}",
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 50,
        maxFiles: 50,
        minFiles:0,
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
            
            setTimeout(()=> {
                  window.location.reload();
              }, 1500)

        },
        init: function() {
            dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

            // for Dropzone to process the queue (instead of default form behavior):
            document.getElementById("submit-all").addEventListener("click", function(e) {
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                if(dzClosure.files.length){
                  dzClosure.processQueue();
                }else{
                  $('#expense_form').submit()
                }
                
				
            });
			
            //send all the form data along with the files:
            this.on("sendingmultiple", function(data, xhr, formData) {
              
              formData.append("_token", "{{ csrf_token() }}");
              formData.append("property_id",$('#property_id').val());
              formData.append("expense_name",$('#expense_name').val());
              formData.append("vendor_id",$('#vendor_id').val());
              formData.append("expense_amount",$('#expense_amount').val());
              formData.append("description",$('#description').val());
              formData.append("expense_date",$('#expense_date').val());
            });
        }
    }
      @if(session('success_msg'))
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            text: "{{session('success_msg')}}",
            showConfirmButton: false,
            timer: 1500,
            width:420
            })
      @endif
      @if(session('error_msg'))
        Swal.fire({
          position: 'top-end',
          icon: 'error',
          text: "{{session('error_msg')}}",
          showConfirmButton: false,
          timer: 1500,
          width:420
          })
      @endif
        </script>
  </body>

</html>