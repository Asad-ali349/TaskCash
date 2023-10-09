
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
                    <h5>Sale Property:</h5>
                    
                  </div>
                  <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/sell_property')}}">
                      @csrf
                      <div class="row g-3 mb-2">
                        <div class="col-md-12">
                          <h6>Property Info</h6>  
                        </div>  
                          <input class="form-control" value="{{$property->id}}"  name="property_id" type="hidden" placeholder="Property Id" readonly>
                        <div class="col-md-8">
                            <label class="form-label" for="">Property Address</label>
                            <input class="form-control" value="{{$property->property_address}}"  name="property_address" type="text" placeholder="Property Address" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="">Property Price With Expense</label>
                            <input class="form-control" value="{{$total_purchase_price_with_expense}}"  name="property_expense" type="text" placeholder="Property Price" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="">Profit %</label>
                            <input class="form-control" id="profit" onkeyup="calculate_profit({{$total_purchase_price_with_expense}})"  name="property_profit" type="number" placeholder="Profit Percentage" required>
                            <span style="color:green; display:none" id="profite_msg"></span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="">Sale Expense</label>
                            <input class="form-control"  name="property_sale_expense" type="number" placeholder="Property Sale Expense"  required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="">Property Contract Document (Optional)</label>
                            <input class="form-control"  name="property_contract_doc" type="file">
                        </div>
                        <hr>
                        <div class="col-md-12">
                          <h6>Sale Info</h6>  
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="">Sale Type</label>
                          <select class="form-control js-example-basic-single col-sm-12" id="sale_type" name="sale_type" required="required" onchange="saletype()">
                              <option>Select Sale Type</option>
                              <option value="Full Payment">Full Paymnet</option>
                              <option value="Lease">Lease</option>
                            
                          </select>
                        </div>
                        <div class="col-md-4" id="invoices" style="display:none">
                          <label class="form-label" >Number Of invoices for lease</label>
                          <input class="form-control"  name="invoices_number" type="text" placeholder="Number Of invoices" >
                        </div>
                        <hr>
                        <div class="col-md-12">
                          <h6>Buyer Info</h6>  
                        </div>
                        <div class="col-md-12">
                          <label class="form-label" for="">Primary Image</label>
                          <select class="form-control js-example-basic-single col-sm-12" id="buyer_id" name="buyer_id" required="required" onchange="addBuyer()">
                              <option value="">Select Buyer</option>
                              <option value="0">Add New Buyer</option>
                              @foreach($buyers as $buyer)
                              <option value="{{$buyer->id}}">{{$buyer->name.' ['.$buyer->email.']'}}</option>
                              @endforeach

                          </select>
                        </div>
                        <div class="col-md-12" id="buyer_data" style="display:none">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label" for="">Buyer Name</label>
                                    <input class="form-control"  name="buyer_name" type="text" placeholder="Buyer Name" >
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="">Email(optional)</label>
                                    <input class="form-control"  name="buyer_email" type="email" placeholder="Buyer Email" >
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="">Phone</label>
                                    <input class="form-control"  name="buyer_phone" type="text" placeholder="Buyer Phone" >
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="">CNIC</label>
                                    <input class="form-control"  name="buyer_cnic" type="text" placeholder="Buyer CNIC" >
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label class="form-label" for="">Address</label>
                                    <textarea  rows="4" class="form-control" name="buyer_address" type="text" placeholder="Buyer Address" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                         <center><input name="" class="btn btn-primary mt-4" type="submit" value="Sell"></center>
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


        function saletype() {
            var saleType=$('#sale_type').val()
            console.log(saleType);
            if(saleType=='Full Payment'){
                $('#invoices').css('display','none')
            }else if(saleType=='Lease'){
                $('#invoices').css('display','block')
                console.log("ffkjk")
            }
        }
        function addBuyer() {
            var buyer_id=$('#buyer_id').val()
            console.log(buyer_id);
            if(buyer_id=='0'){
                $('#buyer_data').css('display','block')
            }else{
                $('#buyer_data').css('display','none')
                
            }
        }
        function calculate_profit(total_price) {
          let profit=$('#profit').val()
          if(profit<=100 && profit>0){
            $('#profite_msg').css('display','block')
            $('#profite_msg').css('color','green')
            $('#profite_msg').text((profit/100)*total_price)
            
          }else{
            $('#profite_msg').css('display','block')
            $('#profite_msg').css('color','red')
            $('#profite_msg').text('Profit % must be 1 to 100')
          }
        }
    </script>
    <script>
        setTimeout(()=> {
            $('#alert').hide('slow')
        }, 3000)
    </script>
  </body>

</html>