@extends('layouts.master')



@section('content')


<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Disputes Detail</h4>
                    
                    @if(session('message'))<p class="alert alert-info">{{session('message')}}</p> @endif
                    <table class="table table-bordered">
                        <tbody>
                        @foreach($resolve_disputes_details as $dispute)
                            <tr>
                                <th>Dispute ID</th>
                                <td>{{$dispute->id}}</td>
                            </tr>
                            <tr>
                                <th>Hotel</th>
                                <td><a href="javascript:void(0)" class="hotel" id="{{ $dispute->hotel->id }}">{{$dispute->hotel->name}}</a></td>
                            </tr>
                            <tr>
                                <th>Consumer</th>
                                <td><a href="javascript:void(0)" class="consumer" id="{{ $dispute->consumer->id }}">{{ $dispute->consumer->first_name }} {{ $dispute->consumer->last_name }}</a></td>
                            </tr>
                            <tr>
                                <th>Dispute Title</th>
                                <td>{{$dispute->d_title}}</td>
                            </tr>
                            <tr>
                                <th>Dispute Body</th> 
                                <td>{{$dispute->d_body}}</td>
                            </tr>
                            <tr>
                                <th>Dispute Reply</th>
                                <td>
                                    {{$dispute->d_reply}}
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


@include('components.consumerShow')
@include('components.restaurant_modal')

@endsection