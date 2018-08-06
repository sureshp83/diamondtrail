<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
{{--<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>--}}

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>




<!-- Morris.js charts -->
<script src="{{ asset('/admin/bower_components/raphael/raphael.min.js')}}"></script>
{{--<script src="{{ asset('/admin/bower_components/morris.js/morris.min.js')}}"></script>--}}
<!-- Sparkline -->
<script src="{{ asset('/admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{ asset('/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('/admin/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('/admin/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{ asset('/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ asset('/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('/admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- adminLTE App -->
<script src="{{ asset('/admin/dist/js/adminlte.min.js')}}"></script>
<!-- adminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{ asset('/admin/dist/js/pages/dashboard.js')}}"></script>--}}
<!-- adminLTE for demo purposes -->
<!-- {{--<script src="{{ asset('/admin/dist/js/demo.js')}}"></script>--}} -->
<![endif]-->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
