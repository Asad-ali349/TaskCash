@extends('layouts.master')



@section('content')
@section('header', 'Resolved Disputes')
            
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Resolved Disputes </h4>
                        @if(session('message'))
                        <p class="alert alert-info">{{session('message')}}</p> 
                        @endif
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.s</th>
                                    <th>Task</th>
                                    <th>Dispute Title</th>
                                    <th>Action</th>                         
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($disputes as $dispute)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="{{ route('task.detail', $dispute->task->id) }}">{{ $dispute->task->title }}</a></td>
                                    <td>{{$dispute->title}}</td>
                                    <td> 
                                        <a  href="{{url('/dispute/'.$dispute->id.'/detail')}}" class="btn btn-sm btn-warning">Detail</a>
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