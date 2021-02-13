<div class="header-top">
    <div class="container">
        <div class="bottom_header_left">
            <p>
                <span class="fa fa-map-marker" aria-hidden="true">

                </span>
                Dhaka, Bangladesh
            </p>
        </div>
        <div class="bottom_header_right">
            <div class="bottom-social-icons">
                <a class="facebook" href="#">
                    <span class="fa fa-facebook"></span>
                </a>
                <a class="twitter" href="#">
                    <span class="fa fa-twitter"></span>
                </a>
                <a class="pinterest" href="#">
                    <span class="fa fa-pinterest-p"></span>
                </a>
                <a class="linkedin" href="#">
                    <span class="fa fa-linkedin"></span>
                </a>
            </div>
            @if(auth()->user())
            <div class="header-top-righ">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                        <span class="fas fa-power-off" aria-hidden="true">{{ __('Logout') }}</span>

                    </a>
                </form>
            </div>
            @else
            <div class="header-top-righ">
                <a href="/user/login">
                    <span class="fa fa-sign-out" aria-hidden="true"></span>Login</a>
            </div>
            @endif
            <div class="clearfix"> </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
