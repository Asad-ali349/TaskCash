                
                <footer class="footer">
                    © 2020 TaskCash - Crafted with <i class="mdi mdi-heart text-danger"></i> by G7Technologies.
                </footer>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/popper.min.js') }}"></script><!-- Popper for Bootstrap -->
        <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('public/assets/js/waves.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.scrollTo.min.js') }}"></script>
          <!--Morris Chart-->
          <script src="{{ asset('public/assets/plugins/morris/morris.min.js') }}"></script>
          <script src="{{ asset('public/assets/plugins/raphael/raphael-min.js') }}"></script>
  
          <script src="{{ asset('public/assets/pages/dashborad.js') }}"></script>
          {{-- DataTables --}}
          <script src="{{ asset('public/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('public/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
        <!-- Responsive examples -->
        <script src="{{ asset('public/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

        {{-- SelectBox --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
        <script>$('select').selectpicker();</script>
        <!-- Datatable init js -->
        <script src="{{ asset('public/assets/pages/datatables.init.js') }}"></script>
        {{-- Ratings --}}
        <script src="{{ asset('public/assets/plugins/bootstrap-rating/bootstrap-rating.min.js') }}"></script>
       <!-- App js -->
       <script src="{{ asset('public/assets/js/app.js') }}"></script>
       <!-- Responsive-table-->
       <script src="{{ asset('public/assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}" type="text/javascript"></script>
       {{-- Switch --}}
       <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
       {{-- Moment js --}}  
       <script src="{{ asset('public/js/moment.js') }}"></script>
       <script src="{{ asset('public\js\swal\sweatAlert.js') }}"></script>
       <script>
       $(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    //        var url = "{{ url('/getAttributeOfSuperAdmin') }}"
    //        $.get(url).done((data)=> {
    //            console.log(data)
    //            $('.completed_order').text(data.total_completed_orders)
    //            $('.pending_order').text(data.total_pending_orders)
    //            $('.accepted_order').text(data.total_accepted_orders)
    //            $('.active_res').text(data.active_hotels)
    //            $('.new_res').text(data.new_hotels)
    //            $('.disable_res').text(data.deactive_hotels)
    //            $('.unResolvedDisputes').text(data.unResolvedDisputes)
    //        })
       })
       </script>
    @stack('scripts')
    </body>
</html>