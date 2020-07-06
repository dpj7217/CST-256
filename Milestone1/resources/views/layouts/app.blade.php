<html>
    <head>
        <title>Socialis - @yield('title')</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
        @yield('head')
    </head>
    <body>
        @yield('navbar', View::make('_navbar'))
        <div id="wrapper">
            @yield('content')
            <div style="margin-bottom: 15%"></div>
            @yield('footer', View::make('_footer'))
        </div>
    </body>
</html>