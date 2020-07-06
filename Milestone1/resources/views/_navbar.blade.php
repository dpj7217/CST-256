<div class="sidebar">
    <img class="logo" src="{{asset('storage/images/logo.png')}}" height="10%" id="logo">
    <div style="margin-top: 30px">

        <a href="{{url('/home')}}" class="navitem {{Request::path() === '/' ? 'activeNavItem' : ''}}">HOME</a>
        @auth
            <a href="{{url('/logout')}}" class="navitem">LOGOUT</a>
        @else
            <a href="{{url('/login')}}" class="navitem {{Request::path() === 'login' ? 'activeNavItem' : ''}}">LOGIN</a>
            <a href="{{url('/register')}}" class="navitem {{Request::path() === 'register' ? 'activeNavItem' : ''}}">REGISTER</a>
        @endauth
        <a href="{{url('/jobs')}}" class="navitem {{Request::path() === 'jobs' ? 'activeNavItem' : ''}}">JOBS</a>
        <a href="{{url('/groups')}}" class="navitem {{Request::path() === 'groups' ? 'activeNavItem' : ''}}">GROUPS</a>
    </div>
</div>


