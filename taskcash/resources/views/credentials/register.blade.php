<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
            <meta content="Admin Dashboard" name="description" />
            <meta content="Themesbrand" name="author" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />

            <!-- App Icons -->
            <link rel="shortcut icon" href="{{ asset('public/assets/images/taskcash.png') }}">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

            <!-- App title -->
            <title>TaskCash</title>
            
            <!-- App css -->
            <link href="{{ asset('public/assets/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />
            <link href="{{ asset('public/assets/css/icons.css') }} " rel="stylesheet" type="text/css" />
            <link href="{{ asset('public/assets/css/style.css') }} " rel="stylesheet" type="text/css" />

        </head>


        <body>

            <!-- Loader -->
            <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

            <!-- Begin page -->
            <div class="accountbg"></div>
            <div class="wrapper-page">

                <div class="card">
                    <div class="card-body">

                        <h3 class="text-center m-0">
                            <a href="login" class="logo logo-admin"><img src="{{ asset('public/assets/images/taskcash.png') }}" height="150" alt="logo"></a>
                        </h3>
                        
                        <div class="p-3">
                            <p class="text-muted text-center">Sign Up to continue to TaskCash.</p>
                            <form class="form-horizontal m-t-30" method="post" action="{{ url('register') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Full Name">
                                    <span class="text-danger name_error">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email">
                                    <span class="text-danger email_error">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter Phone Number">
                                    <span class="text-danger phone_error">{{ $errors->first('phone') }}</span>
                                </div>
                                <label for="password">Password</label>

                                <div class="form-group">
                                    <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control" placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" placeholder="Confirm Password">
                                </div>
                                <span class="text-danger password_error">{{ $errors->first('password') }}</span>
                                <span class="text-danger confirm_password_error">{{ $errors->first('password_confirmation') }}</span>

                                <div class="form-group mt-2">
                                    <label for="">Your Profile Image <code> (Optional)</code></label>
                                    <div style="border-raduis:50%">
                                        <img src="{{ asset('public/assets/images/noUserImage.jpg') }}" id="preview_image" style="cursor:pointer" height="100" onclick="document.getElementById('image').click()">
                                    </div>
                                    <input type="file" name="image" id="image" style="display:none">
                                    <span class="text-danger image_error">{{ $errors->first('image') }}</span>
                                </div>
                                <div class="m-t-40 text-center">
                                    <button class="btn btn-primary w-md waves-effect waves-light" id="button" type="submit">Signup</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="m-t-40 text-center">
                        <p>I Already Have Account <a href="{{ url('login') }}" class="font-500 font-14 text-primary font-secondary"> Login </a> </p>
                        <p>© 2019 TaskCash. Crafted with <i class="mdi mdi-heart text-danger"></i> by G7Technologies</p>
                    </div>
                </div>
            </div>

            <!-- jQuery  -->
            <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
            <script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
            <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('public/assets/js/modernizr.min.js') }}"></script>
            <script src="{{ asset('public/assets/js/waves.js') }}"></script>
            <script src="{{ asset('public/assets/js/jquery.slimscroll.js') }}"></script>
            <script src="{{ asset('public/assets/js/jquery.nicescroll.js') }}"></script>
            <script src="{{ asset('public/assets/js/jquery.scrollTo.min.js') }}"></script>
            <script src="{{ asset('js/swal/sweatAlert.js') }}"></script>
            {{-- SelectBox --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
        <script>$('select').selectpicker();</script>

            <!-- App js -->
            <script src="{{ asset('public/assets/js/app.js') }}"></script>
            <script>
            $(function(){
                $('#password_confirmation').keyup(function(){
                    $('.password_error').text('')
                    $('.confirm_password_error').text('')
                    checkPass()
                })

                $('#password').keyup(function(){
                    $('.confirm_password_error').text('')
                    $('.password_error').text('')
                    checkPass()
                })
                function checkPass(){
                    var pass = $('#password').val()
                    var confirm_pass = $('#password_confirmation').val()

                    console.log(pass.length)
                    if(pass.length > 5){
                        if(confirm_pass == pass){
                            $('.password_error').text('')
                        }
                        else{
                            $('.password_error').text('Passwords Did not match!')
                        }
                    }
                    else{
                        $('.password_error').text('Atleast 6 character or digits for password required!')
                    }
                }

                $('select').selectpicker()
                $('#registerForm').submit(function(e){
                    e.preventDefault()
                    var action = "{{ url('register') }}"
                    var data = $('#registerForm').serialize()
                    $('span.text-danger').text('')
                    $.post(action, data)
                        .done(function(data){
                            window.open('{{ url("login") }}', '_SELF')
                        }) 
                        .fail(function(error){
                            console.log(error.responseJSON.errors)
                            $.each(error.responseJSON.errors, function(key, value){
                                $('.'+key+'_error').text(value)
                            });           
                    })
                })
                $('#image').change(function(){
                    readURL(this);
                })
                function readURL(input) {

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#preview_image').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }   
                $('#hotel_image').change(function(){
                    readURLHotel(this);
                    $('.fa-4x').hide()
                })
                function readURLHotel(input) {

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#preview_hotel_image').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }   
            })
            </script>
        </body>
    </html>