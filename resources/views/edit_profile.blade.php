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
                    <h5>Edit Profile:</h5>
                    
                  </div>
                  <div class="card-body">
                    <form class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST" action="{{url('/edit_profile')}}">
                      @csrf
                      <div class="row g-3 mb-2">
                        <div class="col-md-4">
                          <label class="form-label" >Name</label>
                          <input class="form-control" value="{{$user->name}}" name="name" type="text" placeholder="Name" required="required">
                          
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" >Email</label>
                          <input class="form-control"  value="{{$user->email}}" name="email" type="email" placeholder="Email" required="required">
                          
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" >Phone</label>
                          <input class="form-control"  name="phone" value="{{$user->phone}}" type="text" placeholder="Phone" required="required">
                        </div>
                        
                        <div class="col-md-12">
                          <label class="form-label" >Address</label>
                          <textarea rows="4" class="form-control"   name="address" type="text" placeholder="Address" required="required">{{$user->address}}</textarea>
                        </div>
                        
                        <div class="col-md-4">
                          <label class="form-label" >Profile Image</label>
                          <input class="form-control"  name="profile_image" value="{{$user->profile_image}}" type="file" placeholder="Profile Image">
                        </div>
                        
                        
                        <div class="col-md-12 mt-4">
                         <center><input name="submit" class="btn btn-primary mt-4" type="submit" value="Update Profile"></center>
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
        setTimeout(()=> {
            $('#alert').hide('slow')
        }, 3000)
    </script>
        <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>