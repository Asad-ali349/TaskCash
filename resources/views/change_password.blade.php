
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
              <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
                <div class="card mt-4">
                  <div class="card-header">
                    <h5>Change Password:</h5>
                    
                  </div>
                  <div class="card-body">
                    <form class="needs-validation" novalidate="" method="POST" action="{{url('/change_password')}}">
                      @csrf
                      <div class="row g-3 mb-2">
                        <div class="col-md-12">
                          <label class="form-label" for="">Old Password</label>
                          <input class="form-control" id="" name="oldpassword" type="password" placeholder="Old Password" required="required" minlength="8">
                          <div class="invalid-feedback">Password length must greater than or equal to 8.</div>
                        </div>
                        <div class="col-md-12">
                          <label class="form-label" for="">New Password</label>
                          <input class="form-control" id="password" name="newpass" type="password" placeholder="New Password" required="required" minlength="8">
                          <div class="invalid-feedback">Password length must greater than or equal to 8.</div>
                        </div>
                        
                        
                        <div class="col-md-12">
                          <label class="form-label" for="">Confirm Password</label>
                          <input rows="4" class="form-control" id="confirm_password" name="cpass" type="password" placeholder="Confirm Password" required="required" minlength="8">
                          <div class="invalid-feedback">Password length must greater than or equal to 8.</div>
                          <span id='message'></span>
                        </div>
                        
                        
                        
                        <div class="col-md-12 mt-4">
                         <center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Update Password"></center>
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

        setTimeout(()=> {
            $('#alert').hide('slow')
        }, 3000);


        $('#confirm_password').on('keyup', function () {
          if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Matching').css('color', 'green');
          } else 
            $('#message').html('Not Matching').css('color', 'red');
        });
      </script>
        <!-- login js-->
    <!-- Plugin used-->
  </body>

</html>