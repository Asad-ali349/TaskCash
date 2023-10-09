@extends('layouts.master')



@section('content')
@section('header', 'All Activities')
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
                                        <th>Activity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach($acts as $act)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $act->name }}</td>
                                        <td><span class="badge badge-pill badge-primary">$ {{ $act->price }}</span></td>
                                        <form action="{{ route('categories.destroy', $act->id) }}" method="post" onsubmit="return confirm('Are you Sure To Delete this?')">
                                            @csrf @method('DELETE')
                                        <td>
                                            <a class="btn btn-sm" href="{{ route('activities.edit', $act->id) }}">
                                                <i class="fa fa-edit text-info edit" title="edit" ></i>
                                            </a> 
                                            <input type="hidden" name="status" value="0">
                                            <button class="btn btn-sm">
                                                <i class="fa fa-eraser text-danger delete" title="delete"></i>
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