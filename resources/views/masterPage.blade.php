<!DOCTYPE html>
<html>
    <head>
        <!-- Section for declaring page title -->
        <title>@yield('pageTitle')</title>

        <!-- CCS imports go here -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/appStyle.css')}}">
        <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    </head>

    <body>
        <!-- Section for content -->
        @yield('body')
    </body>

    <footer>

        <!-- Scripts go here -->
        <script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/jquery-ui.js')}}"></script>

        <!-- Section for page specific scripts -->
        @yield('footer')
    </footer>
</html>