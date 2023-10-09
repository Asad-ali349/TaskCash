<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="{{ asset('public/assets/images/taskcash.png') }}">

        <!-- App title -->
        <title>TaskCash</title>
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{ asset('public/assets/plugins/morris/morris.css') }}">
        <!-- Basic Css files -->
        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
        <!-- DataTables -->
        <link href="{{ asset('public/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('public/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        {{-- Ratings --}}
        <link rel="stylesheet" href="{{ asset('public/assets/plugins/bootstrap-rating/bootstrap-rating.css') }}">
        <!-- Table css -->
        <link href="{{ asset('public/assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css" media="screen">
        @yield('styling')
    </head>
    <body class="fixed-left">
        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        @include('busIncludes.leftbar')

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                @include('busIncludes.topbar')
                    <!-- Top Bar End -->
                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->
                    <div class="page-content-wrapper">

                        @yield('content')

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

@include('busIncludes/footer')

      