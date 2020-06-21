<html>
    <head>
        <title>Socialis - @yield('title')</title>
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