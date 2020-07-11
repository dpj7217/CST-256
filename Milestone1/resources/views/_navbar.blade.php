<div class="sidebar">
    <div>
        <img class="logo" src="{{asset('storage/images/logo.png')}}" height="100px" id="logo">
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
    @if(\Auth::user() && \Auth::user()->profile && \Auth::user()->profile->demographics)
        <div id="profileNavContainer">
            <div id="profileNav" style="">
                <a href="{{url('profile/' . \Auth::user()->id . '/view')}}"><img src="{{ \Auth::user()->profile->demographics->profileImageLocation }}" height="100px" width="100px"></a>
            </div>
        </div>
    @endif
</div>


