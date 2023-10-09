
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
           @if(session('success_msg'))
              <div class="alert alert-success mt-2 " role="alert" id="alert">           
                  <strong>Success! </strong>{{session('success_msg')}}
              </div> 
            @endif  
            @if(session('error_msg'))
                <div class="alert alert-danger mt-2 " role="alert" id="alert">           
                    <strong>Error! </strong>{{session('error_msg')}}
                </div> 
            @endif
              <div class="col-sm-12 ">
                <div class="card mt-4">
                  <div class="card-header">
                    <h5>Edit Property Expense:</h5>
                    <p>{{$expense->property->property_address}}</p>
                  </div>
                  <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/edit_expense')}}" id="expense_form">
                      @csrf
                      <input class="form-control" value="{{$expense->id}}" id="expense_id" name="expense_id" type="hidden" placeholder="Property Id" required="required">
                      <div class="row g-3 mb-2">
                        <div class="col-md-4">
                          <label class="form-label" for="">Expense Name</label>
                          <input class="form-control" id="expense_name" name="expense_name" value="{{$expense->name}}" type="text" placeholder="Expense Name" required="required">
                          
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="">Vendor</label>
                          <select class="form-control js-example-basic-single col-sm-12" name="vendor_id" id="vendor_id" required="required">
                              <option value="">Select Vendor</option>
                              @foreach($vendors as $vendor)
                              @if($vendor->id==$expense->vendor_id)
                              <option value="{{$vendor->id}}" selected>{{$vendor->name.' ['.$vendor->service_type->name.']'}}</option>
                              @else
                              <option value="{{$vendor->id}}">{{$vendor->name.' ['.$vendor->service_type->name.']'}}</option>
                              @endif
                              @endforeach
                            
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="">Expense Amount</label>
                          <input class="form-control" id="expense_amount"value="{{$expense->amount}}"  name="expense_amount" type="text" placeholder="Expense Amount" required="required">
                          
                        </div>
                        
                        
                        <div class="col-md-12">
                          <label class="form-label" for="">Description</label>
                          <textarea rows="5" class="form-control" id="description" name="description" type="text" placeholder="Description (optional)">{{$expense->description}}</textarea>
                        </div>
                       
                        <div class="col-md-4">
                          <label class="form-label" for="">Expense Date</label>
                          <input class="form-control" id="expense_date" value="{{$expense->expense_date}}" name="expense_date" type="date" placeholder="Expense Date" required="required">
                        </div>
                        <div class="col-md-12 mt-4">
                          <center><input name="" class="btn btn-primary mt-4" type="submit" value="Update Expense" ></center>
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
     
        setTimeout(()=> {
            $('#alert').hide('slow')
        }, 3000)
    </script>
      
  </body>
</html>