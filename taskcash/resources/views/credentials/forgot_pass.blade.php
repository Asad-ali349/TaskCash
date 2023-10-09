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
                            <p class="text-muted text-center message">Enter Your Email to Recover Password.</p>
                            <form class="form-horizontal m-t-30" method="post" action="{{ url('recover-pass') }}" id="loginform">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Enter Your Email</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                                    <span class="text-danger email_error"></span>
                                </div>
                                <div class="col-sm-12 text-right">
                                    <button class="btn btn-primary btn-block" id="button" type="submit">Submit</button>
                                </div>
                                </div>
                            </form>
                        </div>
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
            <script src="{{ asset('public/js/swal/sweatAlert.js') }}"></script>

            <!-- App js -->
            <script src="{{ asset('public/assets/js/app.js') }}"></script>
            <script>
            $(function(){
                $('#button').click(function(e){
                    e.preventDefault()
                    var action = "{{ url('recover-pass') }}"
                    var data = $('#loginform').serialize()
                    $('span.text-danger').text('')
                    $('#button').text('sending..')
                    $.post(action, data)
                        .done(function(data){
                            console.log(data.error)
                            if(data.hasOwnProperty('error')){
                                $('.email_error').text(data.error)
                            }else{
                                $('.message').text(data.success)
                                $('.message').addClass('text-success')
                                $('#button').text('Submit')
                                $('input').val('')
                            }
                        }) 
                        .fail(function(error){
                            console.log(error.responseJSON.errors)
                            $.each(error.responseJSON.errors, function(key, value){
                                $('.'+key+'_error').text(value)
                            });           
                    })
                })
            })
            </script>
        </body>
    </html>