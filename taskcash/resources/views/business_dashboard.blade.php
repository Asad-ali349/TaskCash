@extends('layouts.busMaster')


@section('content')
<div class="header-bg"> 
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-4 col-xl-4">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-warning">{{ $total_tasks }}</h3>
                        Total Tasks
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-purple">{{ $completed_tasks }}</h3>
                        Completed Tasks
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-danger">{{ $running_tasks }}</h3>
                        Running Tasks
                    </div>
                </div>
            </div> 
            <div class="col-md-4 col-xl-4">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-warning">$ {{ $amount_paid }}</h3>
                        Amount Paid
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-purple">$ {{ $amount_consumed }}</h3>
                        Task Completes
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-danger">{{ $member_since->diffForHumans()    }}</h3>
                        Member Since
                    </div>
                </div>
            </div> 
        </div>
            <!-- end row -->
            <div class="row p-2 bg-white">
                <div class="col-sm-12 ">
                    <h5 class="text-center font-weight-light">Transactions</h5>
                    <hr>
                    {{-- TAbles --}}
                    <table class="table table-bordered table-hover table-striped ">
                        <thead>
                            <tr>
                                <th>No.s</th>
                                <th>Task</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            @forelse($transactions as $val)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('tasks.show', $val->task->id) }}">{{ $val->task->title }}</a></td>
                                <td>{{ $val->transaction_id }}</td>
                                <td><span class="badge badge-pill badge-primary">$ {{ $val->amount }}</span></td>
                                <td>{{ $val->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Transaction History Found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

<script src="{{ asset('public/js/chart.js') }}"></script>

<script>

        $(function(){
             $.get('').done(function(data){
                 chart(data)
                 console.log(data)
             })
             $.get('').done(function(data){
                 branchChart(data)
                 console.log(data)
             })
             
         })
     
         function chart(data){
            var max = Math.max.apply(Math,data.earnings); // 3
            max = max + 20000
             var ctx = document.getElementById('myChart').getContext('2d');
             var chart = new Chart(ctx, {
                 // The type of chart we want to create  
                 type: 'bar',
     
                 // The data for our dataset
                 data: {
                     labels: data.months,
                     datasets: [{
                         label: 'Monthly Earning Graph',
                         backgroundColor: 'rgb(255, 99, 132)',
                         borderColor: 'rgb(15, 99, 132)',
                         data: data.earnings
                     }]
                 },
     
                 // Configuration options go here
                 options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                max: max
                            }
                        }]
                    },
                     tooltips: {
                         mode: 'index',
                         axis: 'y',
                     }
                 }
             });
         }

        //  Branch Chart
        function branchChart(data){
            var max = Math.max.apply(Math,data.earnings); // 3
            max = max + 20000
            var ctx = document.getElementById('myBranchChart').getContext('2d');
             var chart = new Chart(ctx, {
                 // The type of chart we want to create  
                 type: 'bar',
     
                 // The data for our dataset
                 data: {
                     labels: data.months,
                     datasets: [{
                         label: 'Monthly Earning Graph',
                         backgroundColor: 'rgb(255, 99, 132)',
                         borderColor: 'rgb(15, 99, 132)',
                         data: data.earnings
                     }]
                 },
     
                 // Configuration options go here
                 options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                max: max
                            }
                        }]
                    },
                     tooltips: {
                         mode: 'index',
                         axis: 'y',
                     }
                 }
             });
         }
</script>

@endpush