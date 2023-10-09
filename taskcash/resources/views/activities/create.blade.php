@extends('layouts.master')



@section('content')

<div class="container-fluid">
    
        @section('header', 'New Activity')
        
        @if(session('success'))<h3 class="alert alert-success">{{ session('success') }}</h3>@endif
    <div class="row">
        <div class="col-md-6">
                <form action="{{ route('activities.store') }}" method="post">
                    @csrf
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <input type="text" name="name" id="name" class="form-control" placeholder="Write new activity name...">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <input type="text" name="price" id="price" class="form-control" placeholder="price for this activity...">
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
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

