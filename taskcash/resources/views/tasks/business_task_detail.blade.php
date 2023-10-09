@extends('layouts.busMaster')

@section('styling')
<link href="{{ asset('public/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
@section('header', 'Task Detail')
@if(session('success')) <h3 class="alert alert-success">{{ session('success') }}</h3> @endif

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Business Name:</strong> <p class="text-success">{{ $task->business->name }}</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Amount Paid For This Task:</strong> <p class="text-success"><i class="fa fa-money text-primary"></i> {{ $task->transaction->amount }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="list-group text-center text-white">
                                <li class="list-group-item bg-primary mb-1 font-weight-bold">Title</li>
                                <li class="list-group-item bg-primary mb-1 font-weight-bold">Description</li>
                                <li class="list-group-item bg-primary mb-1 font-weight-bold">Category</li>
                                <li class="list-group-item bg-primary mb-1 font-weight-bold">Activities</li>
                                <li class="list-group-item bg-primary mb-1 font-weight-bold">Valid Till</li>
                                <li class="list-group-item bg-primary mb-1 font-weight-bold">Link</li>
                                <li class="list-group-item bg-primary mb-1 font-weight-bold">Status</li>
                            </ul>
                        </div>
                        <div class="col-md-8">
                            <ul class="list-group text-center text-white">
                                <li class="list-group-item text-secondary mb-1 font-weight-light">{{ $task->title }}</li>
                                <li class="list-group-item text-secondary mb-1 font-weight-light">{{ $task->description }}</li>
                                <li class="list-group-item text-secondary mb-1 font-weight-light">{{ $task->category->name }}</li>
                                <li class="list-group-item text-secondary mb-1 font-weight-light">
                                    @foreach($task->activities as $key=>$act)
                                        <span>{{ $act->number_of_act }} {{ $act->act->name }} |</span>
                                    @endforeach
                                </li>
                                <li class="list-group-item text-secondary mb-1 font-weight-light">{{ $task->till->format('M') }} {{ $task->till->format('d') }}, {{ $task->till->format('Y') }}</li>
                                <li class="list-group-item text-secondary mb-1 font-weight-light">{{ $task->link }}</li>
                                <li class="list-group-item text-secondary mb-1 font-weight-light">
                                    @if($task->status == 1) 
                                        <span class="badge badge-pill badge-primary">Approved</span> 
                                    @else 
                                        <span class="badge badge-pill badge-secondary">UnApproved</span> 
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-4">
                        @if($task->jobs->count() > 0)
                        <h5 class="text-center text-warning">Completed Jobs</h5>
                        <table class="table table-striped table-inverse">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>No.s</th>
                                    <th>User Name</th>
                                    <th>Screen Shot</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($task->jobs as $job)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $job->user->name }}</td>
                                    <td><img src="{{ asset('public/assets/images/'.$job->screen_shot) }}" width="100" alt=""></td>
                                    {{-- <td>{{ $job->status == 1 ? 'Verified' : 'Pending' }}</td> --}}
                                    <td>{{ $job->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h5 class="text-warning">No Job Found</h5>
                        @endif
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