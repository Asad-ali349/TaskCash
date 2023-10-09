@extends('layouts.busMaster')



@section('content')
@section('header', 'Generate Dispute')

@if(session('message'))
<p class="alert alert-info">{{session('success')}}</p> 
@endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Create Dispute </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <h4 class="font-weight-bold text-secondary">Task : </h4>
                            </div>
                            <div class="col-md-10">
                                <h4 class="font-weight-light">{{ $task->title }}</h4>
                            </div>
                        </div>
                        <form action="{{ url('dispute/store') }}" id="disputeForm" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 pl-5 pr-5">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="title for your complain..">
                                        <span class="text-danger error_title"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 pl-5 pr-5">
                                    <div class="form-group">
                                        <label for="">Body</label>
                                        <textarea name="message" id="message" rows="5" class="form-control" placeholder="message for your dispute"></textarea>
                                        <span class="text-danger error_message"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                    <button type="submit" class="btn btn-primary btn-lg float-right mr-5">Generate</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
                                
@endsection

@push('scripts')

<script>
    $(function(){
                $('#disputeForm').submit(function(e){
                    e.preventDefault()
                    var action = $('#disputeForm').attr('action')
                    var data = $('#disputeForm').serialize()
                    $('span.text-danger').text('')
                    $.post(action, data)
                        .done(function(data){
                            console.log(data)
                            $('#disputeForm').trigger('reset')
                            Swal.fire({
                                type: 'success',
                                text: 'Successfully Created!',
                            })
                        }) 
                        .fail(function(error){
                            console.log(error.responseJSON.errors)
                            $.each(error.responseJSON.errors, function(key, value){
                                $('.error_'+key).text(value)
                            });           
                    })
                })
            })
</script>


@endpush