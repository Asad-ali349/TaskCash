@extends('layouts.busMaster')

@section('content')
@section('header', 'Edit Profile')
<div class="container">
        @if(session('success'))<h5 class="alert alert-success">{{ session('success') }}</h5>@endif
    <div class="row">
        <div class="col-md-12">
            {{-- Profile --}}
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="media">
                        @if (Auth::guard('business')->user()->image)
                        <img class="d-flex mr-3 rounded-circle thumb-lg" src="{{ asset('public/assets/images/'.Auth::guard('business')->user()->image) }}" alt="Generic placeholder image">
                        @else
                        <img class="d-flex mr-3 rounded-circle thumb-lg" src="{{ asset('public/assets/images/noUserImage.jpg') }}" alt="Generic placeholder image">
                        @endif
                        <div class="media-body">
                            <h5 class="m-t-10 font-18 mb-1">{{ Auth::guard('business')->user()->name }}</h5>
                            <p class="text-muted m-b-5">{{ Auth::guard('business')->user()->email }}</p>
                            <p class="text-muted m-b-5">{{ Auth::guard('business')->user()->phone }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <form action="{{ url('/business/update-profile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Name</span>
                                        </div>
                                        <input type="text" name="name" class="form-control" value="{{ Auth::guard('business')->user()->name }}" placeholder="Name">
                                    </div>
                                    <span class="text-danger">{{ $errors->first('name') }}</span>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Email</span>
                                        </div>
                                        <input type="email" name="email" class="form-control" value="{{ Auth::guard('business')->user()->email }}" placeholder="Email">
                                    </div>
                                    <span class="text-danger">{{ $errors->first('email') }}</span>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Phone</span>
                                        </div>
                                        <input type="phone" name="phone" class="form-control" value="{{ Auth::guard('business')->user()->phone }}" placeholder="Phone">
                                    </div>
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <button type="button" class="btn btn-block btn-success" onclick="document.getElementById('image').click()">ChangeImage</button>
                                            </span>
                                        </div>
                                        <input type="file" name="image" id="image" style="display:none">
                                        @if(Auth::guard('business')->user()->image)
                                        <img src="{{ asset('public/assets/images/'.Auth::guard('business')->user()->image) }}" id="preview" width="150px" alt="" srcset="">
                                        @else
                                        <img src="{{ asset('public/assets/images/noUserImage.jpg') }}" id="preview" width="150px" alt="" srcset="">
                                        @endif
                                    </div>
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-md-4 change_pass_div" id="change_pass_div" style="border:1px solid grey;box-shadow:2px 2px 4px black">
                            @if(session('message'))<h5 class="alert alert-danger">{{ session('message') }}</h5>@endif
                            <form action="{{ route('users.change.pass', Auth::guard('business')->id()) }}" method="post" id="change_pass_form">
                            @csrf
                            <small class="text-primary text-capitalize" id="user_pass_change"></small>
                            <h3 class="text-center text-success" style="text-shadow:0px 0px 5px darkgreen"><i class="fa fa-lock fa-fw"></i> Change Password</h3>
                            <br>
                            <div class="form-group">
                                <label for="current_pass" class=" m-l-10 text-danger">Current Password</label>
                                <div class="input-group">
                                    <input type="password" name="current_pass" id="current_pass" class="form-control" placeholder="current password" value="{{ old('current_pass') }}">
                                    <div class="input-group-addon" id="see_pass"><i class="fa fa-eye text-primary fa-2x"></i></div>
                                </div>
                                    
                            </div>
                            <div class="form-group">
                                <label for="new_pass" class=" m-l-10 text-danger ">New Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="new Password" value="{{ old('password') }}">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="confirm password" value="{{ old('password_confirmation') }}">
                                <span class="text-danger password_error"></span>
                                @foreach($errors->all() as $error)
                                    <code class="text-danger">{{ $error }}</code><br>
                                @endforeach 
                            </div>
                            <div class="form-group">
                                <button class="btn btn-xs btn-success btn-block" id="change_pass">Change</button>
                                <input type="hidden" name="user_id" id="user_id" value="">
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    $(function(){
        $('#password_confirmation').keyup(function(){
            var pass = $('#password').val()
            console.log(pass.length)
            if(pass.length > 5){
                if($(this).val() == pass){
                    $('.password_error').text('')
                }
                else{
                    $('.password_error').text('Passwords Did not match!')
                }
            }
            else{
                $('.password_error').text('Atleast 6 character or digits for password required!')
            }
        })
        $('#image').change(function(){
            readURL(this);
        })
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }   
          // ShowHide PAss
          $('#see_pass').click(function(){
            if($('#current_pass').attr('type') == 'text')
            {
                $('#current_pass').attr('type', 'password')
            }
            else
            {
                $('#current_pass').attr('type', 'text')
            }
        })

    })
</script>

@endpush