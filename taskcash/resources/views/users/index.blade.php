@extends('layouts.master')

@section('styling')
<link href="{{ asset('public/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
@section('header', 'All Users')
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            <a href="{{ route('user.detail', $user->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        </td>
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
<script src="{{ asset('public/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
<script>
    $(function(){
    })
    

</script>

@endpush