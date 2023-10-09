@extends('layouts.busMaster')

@section('styling')
<link href="{{ asset('public/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
@section('header', 'Transactions')
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
                                        <th>Paid For Task</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach($transactions as $val)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('tasks.show', $val->task->id) }}">{{ $val->task->title }}</a></td>
                                        <td>{{ $val->transaction_id }}</td>
                                        <td><span class="badge badge-pill badge-primary">$ {{ $val->amount }}</span></td>
                                        <td>{{ $val->created_at->diffForHumans() }}</td>
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
<script>
    $(function(){
      
        
    })

</script>

@endpush