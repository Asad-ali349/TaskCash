@extends('layouts.busMaster')



@section('content')

<div class="container-fluid">
    
        @section('header', 'Create New Task')
        
        @if(session('success'))<h3 class="alert alert-success">{{ session('success') }}</h3>@endif
    <div class="row bg-white ">
        <div class="col-md-12 p-5">
                <form action="{{ url('tasks') }}" method="post" id="taskForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Task title...">
                                <span class="text-danger title_error">{{ $errors->first('title') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="">Select Category for this Task</label>
                                <select name="category_id" id="category_id" class="form-control" >
                                    @foreach($cats as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger category_id">{{ $errors->first('category_id') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <label for="">Link</label>
                                        <input type="text" name="link" id="link" class="form-control" value="{{ old('link') }}" placeholder="link...">
                                        <span class="text-danger link_error">{{ $errors->first('link') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <label for="">Valid Till</label>
                                        <input type="date" name="till" id="till" class="form-control" min="{{ date('Y-m-d') }}" value="{{ old('till') }}">
                                        <span class="text-danger till_error">{{ $errors->first('till') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary font-weight-bold text-center">Activities 
                                <a href="javascript:void(0)">
                                    <select onchange="addAct()" id="activities" class="form-control form-control-sm" multiple>
                                        @foreach ($acts as $act)
                                            <option value="{{ $act->id }}">{{ $act->name }}</option>
                                        @endforeach
                                    </select>
                                </a>
                            </h5>
                            <div class="row body">
                            </div>
                                    <span class="text-danger total_amount_error"></span>
                                    <span class="text-danger acts0_error"></span>
                                    <span class="text-danger nos0_error"></span>
                                </div>
                        <div class="col-md-12">
                            <div class="form-group"> 
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" id="description" placeholder="Breifly describe about this task">{{ old('description') }}</textarea>
                                <span class="text-danger description_error">{{ $errors->first('description') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                {{-- <input type="submit" class="btn btn-success btn-block" id="submit" value="Add"> --}}
                                <div id="paypal-button"></div>
                                <div>
                                    <span class="font-weight-bold" style="color:red" >Amount: $<strong id="payable_amount">0</strong></span>
                                    <br>
                                    <span class="font-weight-light text-primary">Per Activity <strong>$0.05</strong> will charge</span>
                                    <br>
                                    <span class="font-weight-bold" style="color:red" >Note:</span> <span class="font-weight-light text-success"> "Amount Should be Between $2 to $1000"</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
      
        $(function(){
            var total_amount = 0;
            var no_of_acts = 0;
            var sum_of_acts = 0;
            var amount = 0;
            var form = new FormData()
            $('body').on('keyup', '.number_of_acts', function(){
                total_amount = 0;
                no_of_acts = $(this).length
                sum_of_acts = 0;
                $('.number_of_acts').each((index, val) => {
                    sum_of_acts += parseInt(val.value)
                    // console.log('sum: '+sum_of_acts)
                })
                total_amount = (sum_of_acts * 0.05).toFixed(2)
                $('#payable_amount').text(total_amount)
            })
            paypal.Button.render({
                // Configure environment
                env: 'sandbox',
                client: {
                sandbox: 'AdrM4zlTmm5_E2lh35HYJ5yOgBtq4lHRsjTzX1viGqjU3WIuKoxFA_s1ZgI6C4xah-zDQtlWewm0ipMX',
                // production: 'demo_production_client_id'
                },
                // Customize button (optional)
                locale: 'en_US',
                style: {
                size: 'small',
                color: 'gold',
                shape: 'pill',
                },

                // Enable Pay Now checkout flow (optional)
                commit: true,

                payment: function(data, actions) {
                    var amount = 0;
                        $('.text-danger').text('')
                        form.append('_token', '{{ csrf_token() }}')
                        getFormElements(form)
                        $.ajax({
                            url: "{{ url('/tasks/validate') }}",
                            data: form,
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            cache: false,
                        }).success((result)=> {
                            console.log('1total_amount: '+ total_amount)
                        }).error((error)=> {
                            console.log(error.responseJSON.errors)
                            console.log('total_amount: '+ total_amount)
                            $.each(error.responseJSON.errors, function(key, value){
                                $('.'+key+'_error').text(value)
                            });  
                            $('.act0_error').text(error.responseJSON.errors.acts[0])
                            $('.nos0_error').text(error.responseJSON.errors.nos[0])
                            if(error.responseJSON.errors.total_amount){
                                $('.total_amount_error').text('Amount Should be atleast $2')
                            }
                        })
                        return actions.payment.create({
                            transactions: [{
                            amount: {
                                total: getTotalAmount(),
                                currency: 'USD'
                            }
                            }]
                        });
                    },
                // Execute the payment
                onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function(details) {
                    // Show a confirmation message to the buyer
                    console.log(details)
                    var amount = details.transactions[0].amount.total
                    var transaction_id = details.transactions[0].related_resources[0].sale.id
                    var _token = "{{ csrf_token() }}"
                   
                    form.append('amount', amount)
                    form.append('transaction_id', transaction_id)
                    // data.append('_token', _token)
                    console.log(form)
                    $.ajax({
                        url: "{{ url('/tasks') }}",
                        data: form,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        cache: false,
                    }).success((result)=> {
                        console.log(result)
                        $('#taskForm').trigger('reset')
                    }).error((error)=> {
                        console.log(error.responseJSON.errors)
                    })
                });
                }
            }, '#paypal-button');
            
        function getTotalAmount()
        {
            total_amount = 0;
            no_of_acts = $('.number_of_acts').length
            sum_of_acts = 0;
            $('.number_of_acts').each((index, val) => {
                sum_of_acts += parseInt(val.value)
                // console.log('sum: '+sum_of_acts)
            })
            total_amount = (sum_of_acts * 0.05).toFixed(2)
            if(total_amount >= 2){
                return total_amount
            }else{
                return 0;
            }
        }

        function getFormElements(form)
        {
            form.append('title', $('#title').val())
            form.append('category_id', $('#category_id').val())
            form.append('description', $('#description').val())
            form.append('link', $('#link').val())
            form.append('till', $('#till').val())
            form.append('acts', acts)
            form.append('nos', nos)
            form.append('total_amount', getTotalAmount())
        }
           
        })
        var acts = [];
        var nos = [];
        $('body').on('keyup', '.number_of_acts', ()=> {
            nos = []
            $('.number_of_acts').each((index, val)=> {
                console.log(val)
                nos.push(val.value)
                console.log(nos)
            })
        })
        function addAct(){
            $('.body').html('')
            var select = $('#activities').val()
            var value = '';
            acts = select
            select.forEach((element, index) => {
                value = activities.selectedOptions[index].text
                id = activities.selectedOptions[index].value
                var html = '<div class="col-md-12"><div class="row">'+
                            '<div class="col-md-6 mt-2">'+
                                '<div class="form-group">'+
                                    '<input type="text" class="form-control form-control-sm" value="'+value+'" readonly>'+
                                    '<input type="hidden" name="acts[]" class="form-control form-control-sm acts" value="'+id+'" readonly>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-5 mt-2">'+
                                '<div class="form-group">'+
                                    '<input type="number" name="nos[]" class="form-control form-control-sm nos number_of_acts" min="1" placeholder="enter number of activities">'+
                                '</div>'+
                            '</div></div></div>';
                $('.body').append(html);
            });
            console.log(select)
        }
        
        
    </script>
@endpush