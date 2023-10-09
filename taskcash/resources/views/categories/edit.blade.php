@extends('layouts.master')



@section('content')

<div class="container-fluid">
    
        @section('header', 'Edit Category')
        
        @if(session('success'))<h3 class="alert alert-success">{{ session('succcess') }}</h3>@endif
    <div class="row">
        <div class="col-md-6">
                <form action="{{ route('categories.update', $category->id) }}" method="post">
                    @csrf @method('PUT')
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" placeholder="Write new Category name...">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                            <input type="submit" class="btn btn-success btn-block" id="submit" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

