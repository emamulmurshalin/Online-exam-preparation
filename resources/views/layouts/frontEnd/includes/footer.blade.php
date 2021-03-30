<div class="mkl_footer">
    <div class="sub-footer">
        <div class="container">
            <div class="mkls_footer_grid">
                <div class="col-xs-4 mkls_footer_grid_left">
                    <h4 style="color: white;">Location:</h4>
                    <p style="color: white;">Dhanmondi 32,
                        <br> Dhaka, Bangladesh</p>
                </div>
                <div class="col-xs-4 mkls_footer_grid_left">
                    <h4>Mail Us:</h4>
                    <p style="color: white;">
                        <span>Phone : </span>01772-222111</p>
                    <p>
                        <span style="color: white;">Email : </span>
                        <a style="color: white;" href="/">admin@demo.com</a>
                    </p>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="botttom-nav-allah">
                <ul>
                    <li class="active">
                        <a href="/" class="effect-3">Home</a>
                    </li>
                    @if(auth()->user())
                        <li>
                            <a href="/exam/model-test" class="effect-3">Model test</a>
                        </li>
                    @endif
                    <li>
                        <a href="/exam/question" class="effect-3">Question</a>
                    </li>
                    <li>
                        <a href="/exam/contact-us" class="effect-3">Contact Us</a>
                    </li>
                    <li>
                        <a href="/exam/about" class="effect-3">About Us</a>
                    </li>
                    <li>
                        <a href="/exam/blog" class="effect-3">Blog</a>
                    </li>
                    @if(!auth()->user())
                        <li>
                            <a href="/user/registration" class="effect-3">Sign up</a>
                        </li>
                        <li>
                            <a href="/user/login" class="effect-3">Login</a>
                        </li>
                    @else
                        <li>
                            <a href="/dashboard" class="effect-3">Dashboard</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copy-right">
        <div class="container">
            <div class="allah-copy">
                <p>© 2020 Online Preparation. All rights reserved | Design by
                    <a href="/">Group members</a>
                </p>
            </div>
            <div class="footercopy-social">
                <ul>
                    <li>
                        <a href="#">
                            <span class="fa fa-facebook"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa fa-twitter"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa fa-rss"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa fa-vk"></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
