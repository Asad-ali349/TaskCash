@include('includes/header_start')

@include('includes/header_end')

                            <!-- Page title -->
                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                                <li class="hide-phone list-inline-item app-search">
                                    <h3 class="page-title">Alerts</h3>
                                </li>
                            </ul>

                            <div class="clearfix"></div>
                        </nav>

                    </div>
                    <!-- Top Bar End -->

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card m-b-20">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">Examples</h4>
                                            <p class="text-muted m-b-30 font-14">Alerts are available for any length of
                                                text, as well as an optional dismiss button. For proper styling, use one
                                                of the four <strong>required</strong> contextual classes (e.g., <code
                                                        class="highlighter-rouge">.alert-success</code>). For inline
                                                dismissal, use the alerts jQuery plugin.</p>
            
                                            <div class="">
                                                <div class="alert alert-success" role="alert">
                                                    <strong>Well done!</strong> You successfully read this important alert message.
                                                </div>
                                                <div class="alert alert-info" role="alert">
                                                    <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                                                </div>
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Warning!</strong> Better check yourself, you're not looking too good.
                                                </div>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Oh snap!</strong> Change a few things up and try submitting again.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-lg-6">
                                    <div class="card m-b-20">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">Link color</h4>
                                            <p class="text-muted m-b-30 font-14">Use the <code
                                                    class="highlighter-rouge">.alert-link</code> utility class to
                                                quickly provide matching colored links within any alert.</p>
            
                                            <div class="">
                                                <div class="alert alert-success" role="alert">
                                                    <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
                                                </div>
                                                <div class="alert alert-info" role="alert">
                                                    <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important.
                                                </div>
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Warning!</strong> Better check yourself, you're <a href="#" class="alert-link">not looking too good</a>.
                                                </div>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card m-b-20">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">Dismissing</h4>
                                            <p class="text-muted m-b-30 font-14">You can see this in action with a live demo:</p>
            
                                            <div class="">
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <strong>Well done!</strong> You successfully read this important alert message.
                                                </div>
                                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <strong>Warning!</strong> Better check yourself, you're not looking too good.
                                                </div>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <strong>Oh snap!</strong> Change a few things up and try submitting again.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-lg-6">
                                    <div class="card m-b-20">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">Additional content</h4>
                                            <p class="text-muted m-b-30 font-14">Alerts can also contain additional HTML elements like headings and paragraphs.</p>
            
                                            <div class="">
                                                <div class="alert alert-success" role="alert">
                                                    <h4 class="alert-heading font-18">Well done!</h4>
                                                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                                                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card m-b-20">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">Examples</h4>
                                            <p class="text-muted m-b-30 font-14">Alerts are available for any length of
                                                text, as well as an optional dismiss button. For proper styling, use one
                                                of the four <strong>required</strong> contextual classes (e.g., <code
                                                        class="highlighter-rouge">.alert-success .bg-**</code>). For inline
                                                dismissal, use the alerts jQuery plugin.</p>
            
                                            <div class="">
                                                <div class="alert alert-success bg-success text-white" role="alert">
                                                    <strong>Well done!</strong> You successfully read this important alert message.
                                                </div>
                                                <div class="alert alert-info bg-info text-white" role="alert">
                                                    <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                                                </div>
                                                <div class="alert alert-warning bg-warning text-white" role="alert">
                                                    <strong>Warning!</strong> Better check yourself, you're not looking too good.
                                                </div>
                                                <div class="alert alert-danger bg-danger text-white" role="alert">
                                                    <strong>Oh snap!</strong> Change a few things up and try submitting again.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            

                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

@include('includes/footer_start')

@include('includes/footer_end')