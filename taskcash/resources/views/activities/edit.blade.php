@extends('layouts.master')



@section('content')

<div class="container-fluid">
    
        @section('header', 'Edit Activity')
        
        @if(session('success'))<h3 class="alert alert-success">{{ session('succcess') }}</h3>@endif
    <div class="row">
        <div class="col-md-6">
                <form action="{{ route('activities.update', $activity->id) }}" method="post">
                    @csrf @method('PUT')
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <input type="text" name="name" id="name" class="form-control" value="{{ $activity->name }}" placeholder="Write new activity name...">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <input type="text" name="price" id="price" class="form-control" value="{{ $activity->price }}" placeholder="Write new activity name...">
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                            <input type="submit" class="btn btn-success btn-block" id="submit" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

