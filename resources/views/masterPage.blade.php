<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Section for declaring page title -->
    <title>@yield('pageTitle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('img/vector/logo.svg')}}">

    <!-- CCS imports go here -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/flat-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/appStyle.css')}}">
</head>

<body>
<!-- Section for content -->
@yield('body')
</body>

<footer>

    <!-- Scripts go here -->
    <script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/flat-ui.min.js')}}"></script>

    <!-- Section for page specific scripts -->
    @yield('footer')
</footer>
</html>