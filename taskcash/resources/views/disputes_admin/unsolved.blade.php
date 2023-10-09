@extends('layouts.master')



@section('content')
@section('header', 'Disputes')
            
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Disputes Data Table</h4>
                        @if(session('message'))
                        <p class="alert alert-info">{{session('message')}}</p> 
                        @endif
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.s</th>
                                    <th>Task</th>
                                    <th>Dispute Title</th>
                                    <th>Dispute Body</th>  
                                    <th>Action</th>                         
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($disputes as $dispute)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="{{ route('task.detail', $dispute->task->id) }}">{{ $dispute->task->title }}</a></td>
                                    <td>{{$dispute->title}}</td>
                                    <td>{{ \Str::limit($dispute->message, 50, '..') }}</td>
                                    <td> 
                                        <a  href="{{url('/dispute/'.$dispute->id.'/detail')}}" class="btn btn-sm btn-warning">Reply</a>
                                    </td>
                                </tr>
                                @endforeach  
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

@endsection

@push('scripts')



@endpush