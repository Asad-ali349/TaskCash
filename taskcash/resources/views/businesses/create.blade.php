@extends('layouts.master')



@section('content')

<div class="container-fluid">
    
        @section('header', 'New Business')
        
        @if(session('success'))<h3 class="alert alert-success">{{ session('success') }}</h3>@endif
    <div class="row bg-white p-5">
        <div class="col-md-8">
                <form action="{{ url('business/store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Business name...">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Business email...">
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="enter password (minimum 6 characters)...">
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="enter phone...">
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="">File</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block" id="submit" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

