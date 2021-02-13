<div class="header">
    <div class="content white">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        <h1>
                            <span class="fa fa-leanpub" aria-hidden="true"></span>Online Exam Preparation
                            <label>Quiz & Question</label>
                        </h1>
                    </a>
                </div>
                <!--/.navbar-header-->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <nav class="link-effect-2" id="link-effect-2">
                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a href="/" class="effect-3">Home</a>
                            </li>
                            <li>
                                <a href="/exam/model-test" class="effect-3">Model test</a>
                            </li>
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
                            @endif
                        </ul>
                    </nav>
                </div>
                <!--/.navbar-collapse-->
                <!--/.navbar-->
            </div>
        </nav>
    </div>
</div>
