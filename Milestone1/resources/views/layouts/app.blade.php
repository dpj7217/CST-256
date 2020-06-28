<html>
    <head>
        <title>Socialis - @yield('title')</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        @yield('head')
    </head>
    <body>
        @yield('navbar', View::make('_header'))

        <div class="container">
            @yield('content')
        </div>
    </body>
    <footer>
        @yield('footer', View::make('_footer'))
    </footer>
</html>