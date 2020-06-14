<html>
    <head>
        <title>App Name - @yield('title')</title>
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