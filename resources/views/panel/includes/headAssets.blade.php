<link rel="icon" type="image/ico" href="public/favicon.ico">
<!-- jQuery -->
<script src="{{asset('public/panel')}}/vendor/jquery/jquery.min.js"></script>

<!-- Custom CSS -->
<link href="{{asset('public/panel/custom/styles.css')}}" rel="stylesheet">

<!-- Bootstrap Core CSS -->
<link href="{{asset('public/panel')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="{{asset('public/panel')}}/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{asset('public/panel')}}/dist/css/sb-admin-2.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="{{asset('public/panel')}}/vendor/morrisjs/morris.css" rel="stylesheet">

<!-- DataTables files from https://datatables.net/manual/installation for table sorting -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
<script src="{{asset('public/panel')}}/vendor/jquery/jquery.min.js"></script>

<script type="text/javascript" charset="utf8" src="{{ asset('public/panel/vendor/datatables/js/jquery.dataTables.js')
}}"></script>

<!-- Custom Fonts -->
<link href="{{asset('public/panel')}}/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('public/panel')}}/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('public/panel')}}/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="{{asset('public/panel')}}/vendor/raphael/raphael.min.js"></script>
<script src="{{asset('public/panel')}}/vendor/morrisjs/morris.min.js"></script>
<script src="{{asset('public/panel')}}/data/morris-data.js"></script>

<link href="{{ asset('public/panel/vendor/select2/select2.min.css') }}" rel="stylesheet"/>



<style>
    @media only screen and (min-width: 768px) {
        .sidebar {
            min-height: 1200px;
            background-color: #263238;
        }

        nav.navbar.navbar-default.navbar-static-top,
        .nav > li > a:hover,
        .nav > li > a:active,
        .nav > li > a:focus
        {
            background-color: #263238;
        }

        .sidebar ul li a.active {
            background-color: transparent;
        }

        .sidebar .nav > li > a {
            color: #fafafa;
        }
        .sidebar ul li {
            border-bottom: none;
        }
        .sidebar .nav>li>a i.fa {
            font-size: 18px;
            margin-right: 5px;
        }
    }
</style>