@extends('layouts.master')



@section('content')
@section('header', 'All categories')
@if(session('success')) <h3 class="alert alert-success">{{ session('success') }}</h3> @endif
<div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="card m-b-30">
                    <div class="card-body">
                        
                    {{-- TAbles --}}
                    <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <table id="datatable" class="table table-bordered table-hover table-striped dataTable no-footer" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr>
                                        <th>No.s</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cats as $cat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cat->name }}</td>
                                        <form action="{{ route('categories.destroy', $cat->id) }}" method="post" onsubmit="return confirm('Are you Sure To Delete this?')">
                                            @csrf @method('DELETE')
                                        <td>
                                            <a class="btn btn-sm" href="{{ route('categories.edit', $cat->id) }}">
                                                <i class="fa fa-edit text-info edit" title="edit" ></i>
                                            </a> 
                                            <input type="hidden" name="status" value="0">
                                            <button class="btn btn-sm">
                                                <i class="fa fa-trash text-danger delete" title="delete"></i>
                                            </button> 
                                        </td>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

{{-- <script>
    $(function(){
        $('.add').click(function(e){
            e.preventDefault()
            var id = $(this).attr('id')
            console.log(id)
        })
        
    })
    

</script> --}}

@endpush