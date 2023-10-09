<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from admin.pixelstrap.com/cuba/theme/login-sa-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Apr 2021 09:54:10 GMT -->
@include('includes.head')
  <body>
    <!-- login page start-->
    <div class="container-fluid">
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
      <div class="row">
        <div class="col-12 p-0">
          <div class="login-card">
            <div>
              <div><center><img class="img-fluid for-light" src="{{asset('public/assets/images/logo/login.png')}}" width="200px" style="margin-bottom:20px" alt="looginpage"></center></div>
              <div class="login-main"> 
                <form class="theme-form" action="{{url('/login')}}" method='post'>
                  @csrf
                  <h4>Sign in to account</h4>
                  <p>Enter your email & password to login</p>
                  <div class="form-group">
                    <label class="col-form-label">Email Address</label>
                    <input class="form-control" name="email" type="email" required="" placeholder="Test@gmail.com">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" required="" placeholder="*********">
                      <div class="show-hide"><span class="show">                         </span></div>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div class="checkbox p-0">
                      <input id="checkbox1" type="checkbox">
                      <label class="text-muted" for="checkbox1">Remember password</label>
                    </div><a class="link" href="{{url('/forgot_password')}}">Forgot password?</a>
                    <div class="text-end mt-3">
                      <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                    </div>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
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
      <!-- Sidebar jquery-->
      <script src="{{asset('public/assets/js/config.js')}}"></script>
      <!-- Plugins JS start-->
      <script src="{{asset('public/assets/js/sweet-alert/sweetalert.min.js')}}"></script>
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="{{asset('public/assets/js/script.js')}}"></script>
      <!-- login js-->
      <!-- Plugin used-->
      <script>
        $(document).on('click', '#error', function(e) {
          if($('.email').val() == '' || $('.pwd').val() == ''){
          swal(
            "Error!", "Sorry, looks like some data are not filled, please try again !", "error"           
          )
          }
        });
      </script>
      <script>
        setTimeout(()=> {
            $('#alert').hide('slow')
        }, 3000)
    </script>
    </div>
  </body>
</html>