<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js')}}" lang=" en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PT. Pertani</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{url('template-admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('template-admin/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('template-admin/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('template-admin/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{url('template-admin/vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{url('template-admin/vendors/jqvmap/dist/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{url('template-admin/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">


    <link rel="stylesheet" href="{{url('template-admin/assets/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
<!-- Right Panel -->
@include('partials.v_sidebar')

<div id="right-panel" class="right-panel">

    @include('partials/v_header')

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>@yield("title")</h1>
                </div>
            </div>
        </div>
    </div>
    {{--    content --}}
    <div class="content mt-3 mb-lg-5">
        @if(Session::has('msg'))
            <div class="alert alert-warning text-center"><span class="badge badge-danger">Info</span>
                : {{Session::get('msg')}}</div>
        @endif
        @yield('content')
    </div>
    {{--    endcontent--}}
</div>
<!-- Right Panel -->

<script src="{{url('template-admin/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('template-admin/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{url('template-admin/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{url('template-admin/assets/js/main.js')}}"></script>


<script src="{{url('template-admin/vendors/chart.js/dist/Chart.bundle.min.js')}}"></script>
<script src="{{url('template-admin/vendors/chart.js/dist/Chart.js')}}"></script>
<script src="{{url('template-admin/assets/js/dashboard.js')}}"></script>
<script src="{{url('template-admin/assets/js/widgets.js')}}"></script>
<script src="{{url('template-admin/vendors/jqvmap/dist/jquery.vmap.min.js')}}"></script>
<script src="{{url('template-admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
<script src="{{url('template-admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{url('template-admin/vendors/datatables.net/js/jquery.dataTables.js')}}"></script>
<script src="{{url('template-admin/vendors/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
    (function ($) {
        "use strict";
        $('#bootstrap-data-table').DataTable({
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
        });

        $('#bootstrap-data-table-export').DataTable({
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        });

        $('#row-select').DataTable({
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });
        @if(Request::segment(1) == 'dashboard')
            @yield('barchart')
        @endif
    })(jQuery);
</script>

</body>
</html>
