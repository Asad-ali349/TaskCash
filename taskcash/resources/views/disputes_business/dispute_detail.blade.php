@extends('layouts.busMaster')


@section('header', 'Dispute Detail')
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Disputes Detail</h4>
                    @if(session('message'))
                        <p class="alert alert-info">{{session('message')}}</p> 
                    @endif
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Dispute Title</th>
                                <td>{{ $dispute->title }}</td>
                            </tr>
                            <tr>
                                <th>Dispute Body</th> 
                                <td>{{ $dispute->message }}</td>
                            </tr>
                            <tr>
                                <th>Reply</th> 
                                <td>{{ ($dispute->status == 0) ? '( Unresolved )' : '( Resolved )' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body order-list">
                    @if(session('message'))
                        <p class="alert alert-success">{{session('message')}}</p> 
                    @endif
                    <h4 class="header-title mt-0 mb-3">Query Chat ({{ ($dispute->status == 1) ? 'Resolved' : 'UnSolved' }})</h4>
                    @if($chats->count() > 0)
                    @foreach($chats as $chat)
                    @if($chat->sent_by == 'admin')
                        <p class="text-right text-dark"><b>Admin:</b>  {{ $chat->message }}</p>
                    @else
                        <p class="text-left text-dark"><b>You</b>: {{ $chat->message }}</p>
                    @endif
                    
                    @endforeach
                    @else
                    
                    <p>No messages</p>
                    @endif
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
        @if($dispute->status == 0)
        <div class="col-md-12">
            <form method="post" action="{{url('dispute/'.$dispute->id.'/bus_reply')}}">
                {{csrf_field()}}
                <input type="hidden" name="sender" value="{{ Auth::guard('business')->user()->id }}">
                <div class="form-group p-2">
                    <textarea name="message" class="form-control" cols="5" rows="5" placeholder="Enter Your Reply Here...">{{ old('message') }}</textarea><br/>
                    <p class="text-danger"> {{$errors->first('message')}}</p>   
                    <div class="form-group">
                        <div class="col-lg-12 ml-auto text-right">
                            <a href="{{ url('/dispute/'.$dispute->id.'/bus_resolve/') }}" class="btn btn-success">Resolve Query</a>
                            <input type="submit" name="submit" class="btn btn-primary" value="Reply">
                        </div>
                    </div>  
                </div>
            </form>
        </div>
        @endif
    </div><!--end row-->
</div> <!-- Page content Wrapper -->

@endsection