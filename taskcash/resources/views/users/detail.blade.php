@extends('layouts.master')

@section('styling')
<link href="{{ asset('public/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
@section('header', 'User Detail')
@if(session('success')) <h3 class="alert alert-success">{{ session('success') }}</h3> @endif
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            {{-- Profile --}}
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="media">
                        @if ($user->image)
                        <img class="d-flex mr-3 rounded-circle thumb-lg" src="{{ asset('public/assets/images/employees/'.$user->image) }}" alt="Generic placeholder image">
                        @else
                        <img class="d-flex mr-3 rounded-circle thumb-lg" src="{{ asset('public/assets/images/noUserImage.jpg') }}" alt="Generic placeholder image">
                        @endif
                        <div class="media-body">
                            <h5 class="m-t-10 font-18 mb-1">{{ $user->name }}</h5>
                            <p class="text-muted m-b-5">{{ $user->email }}</p>
                            <p class="text-muted font-14 font-500 font-secondary">{{ $user->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                    {{-- TAbles --}}
                    <h5 class="card-title ml-5 text-success">All Completed Jobs</h5>
                        <table class="table table-bordered table-hover table-striped ">
                            <thead>
                                <tr>
                                    <th>No.s</th>
                                    <th>Task</th>
                                    <th>Business</th>
                                    <th>Screen Shot</th>
                                    <th>Activities</th>
                                    <th>link</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($user->jobs as $job)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('task.detail', $job->task->id) }}">{{ $job->task->title }}</a>
                                    <td>{{ $job->task->business->name }}</td>
                                    <td>{{ $job->screen_shot }}</td>
                                    <td>
                                        @foreach($job->task->activities as $key=>$act)
                                            <span>{{ $act->act->name }} |</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $job->task->link }}</td>
                                    <td>{{ $job->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="card-title ml-5 text-success">Transactions</h5>
                        <table class="table table-bordered table-hover table-striped ">
                            <thead>
                                <tr>
                                    <th>No.s</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($user->requests as $request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <th>$ {{ $request->amount }}</th>
                                    <td>{{ $request->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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