<!DOCTYPE HTML>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!----- start head assets---->
    @include('frontEnd.includes.headAssets')
    <!----- end head assets---->
</head>
<body>
@include('frontEnd.includes.header')
@include('frontEnd.includes.about')
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
</body>
</html>
