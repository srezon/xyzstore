<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta and Title Start -->
@include('panel.includes.headMeta')
<!-- Meta and Title End -->

    <!-- CSS and JS Start -->
@include('panel.includes.headAssets')
<!-- CSS and JS End -->
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        @include('panel.includes.header')
        <!-- /.navbar-top-links -->
        @include('panel.includes.menu')
        <!-- /.sidebar-collapse -->
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        @yield('content')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->





















<!-- JS and Jquery start -->
@include('panel.includes.footerAssets')
<!-- JS and Jquery end -->

</body>

</html>
