@extends('layouts.master')


@section('content')
@section('header', 'Admin Dashboard')
<div class="header-bg"> 
        
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-4 col-xl-4">
                <div class="card text-center ">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-info">{{ $totalBusinesses }}</h3>
                        Total Businesses
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card text-center ">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-purple">{{ $totalTasks }}</h3>
                        Total Tasks
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card text-center">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-primary">{{ $totalUsers }}</h3>
                        Users
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4 mt-1">
                <div class="card text-center ">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-warning">{{ $running_tasks }}</h3>
                        Running Tasks
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4 mt-1">
                <div class="card text-center ">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-primary">{{ $completed_tasks }}</h3>
                        Completed Tasks
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4 mt-1">
                <div class="card text-center">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-danger">$ {{ $amountCollected }}</h3>
                        Amount Collected
                    </div>
                </div>
            </div>
        <!-- end row -->
        </div>
        <div class="row mt-2">
            <div class="col-12 mb-4">
                <h5 class="text-center text-capitalize bg-white p-3 text-success" >Monthly Registeration Graph</h5>
                <canvas id="BusinessAndUserRegisterChart"></canvas>
            </div>
            {{-- <div class="col-6 mb-4">
                <h2 class="text-center text-capitalize bg-white p-3 text-danger" style="font-family: 'Long Cang', cursive;">Hotels Joining per Month</h2>
                <canvas id="RestaurantsChart"></canvas>
            </div> --}}
        </div>
    </div>
</div>

    


@endsection


@push('scripts')

<script src="{{ asset('public/js/chart.js') }}"></script>

<script>

        $(function(){
            
             $.get("{{ url('register-chart') }}").done(function(data){
                BusinessAndUserRegisterChart(data)
                console.log(data)
             })

            //  $.get('').done(function(data){
            //      RestaurantChart(data)
            //      console.log(data)
            //  })
             
         })
     
         function BusinessAndUserRegisterChart(data){
            // var max = Math.max.apply(Math,data.earnings); // 3
            // max = max + 20000
                var ctx = document.getElementById('BusinessAndUserRegisterChart').getContext('2d');
                var chart = new Chart(ctx, {
                    // The type of chart we want to create  
                    type: 'bar',
        
                    // The data for our dataset
                    data: {
                        labels: data.months,
                        datasets: [
                        {
                            label: 'Businesses',
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(15, 99, 132)',
                            data: data.data.businesses
                        },
                        {
                            label: 'Users',
                            backgroundColor: 'rgb(115, 45, 112)',
                            borderColor: 'rgb(20, 09, 155)',
                            data: data.data.users
                        },
                        ]
                    },
        
                    // Configuration options go here
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    // max: max
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

            function RestaurantChart(data){
                var max = Math.max.apply(Math,data.registrations); // 3
                max = max + 10
                var ctx = document.getElementById('RestaurantsChart').getContext('2d');
                var chart = new Chart(ctx, {
                    // The type of chart we want to create  
                    type: 'bar',
        
                    // The data for our dataset
                    data: {
                        labels: data.months,
                        datasets: [{
                            label: 'Monthly Registered Hotels',
                            backgroundColor: 'rgb(55, 919, 55)',
                            borderColor: 'rgb(150, 003, 332)',
                            data: data.registrations
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