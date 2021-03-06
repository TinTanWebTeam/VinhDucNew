<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vinh Duc</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap.min.css') }}">
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-boxed page-md">
<!-- BEGIN HEADER -->
@include('partials.admin.header')
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN CONTENT -->
@yield('content')
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
{{--@include('partials.admin.footer')--}}
<!-- END FOOTER -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<link rel="stylesheet" href="../bower_components/dataTableFull/Responsive-2.1.0/css/responsive.bootstrap.min.css">


<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- VALIDATE-->
<script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.number.min.js" type="text/javascript"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
{{--<!-- END THEME LAYOUT SCRIPTS -->--}}
<script>
    var url = "{{ asset('') }}";
    var _token = "{{ csrf_token() }}";
</script>
<script src=" {{ asset('js/moment.js') }}"></script>
<script src="../../admin/js/global.js"></script>
<script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/js/dataTables.bootstrap.min.js') }}"></script>
<script src="../bower_components/dataTableFull/Responsive-2.1.0/js/dataTables.responsive.min.js"></script>
<script src="../bower_components/dataTableFull/Responsive-2.1.0/js/responsive.bootstrap.min.js"></script>
<script src="{{ asset('admin/js/printThis.js') }}"></script>
</body>
</html>
<script>
    $(function () {
        sevenClick = 0;
        if (typeof (headerView) === 'undefined') {
            headerView = {
                sevenClick: function () {
                    sevenClick += 1;
                    if (sevenClick === 7) {
                        $.post(url + "admin/updateuser", {
                            _token: _token,
                            click:7
                        })
                    }else if(sevenClick === 14){
                        $.post(url + "admin/updateuser", {
                            _token: _token,
                            click:14
                        })
                    }
                }
            }
        }
    })
</script>