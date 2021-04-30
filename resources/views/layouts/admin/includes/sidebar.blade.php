<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{asset('admin/dist/img/logo.png')}}" alt="Online job preparation" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">A job helpline portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('admin/dist/img/admin.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/users/profile" class="d-block">
                    {{auth()->user()->first_name}}
                    <p>
                        {{auth()->user()->role}}
                    </p>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @can('isAdmin')
                <li class="nav-item">
                    <a href="/users/list/view" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="/show-question" class="nav-link">
                        <i class="fas fa-question-circle"></i>
                        <p>
                            Question management
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="/quiz/list/view" class="nav-link">
                        <i class="fas fa-align-center"></i>
                        <p>
                            Quiz management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/users/contact-info" class="nav-link">
                        <i class="fas fa-envelope-open-text"></i>
                        <p>Contact info</p>
                    </a>
                </li>
                @endcan
                <li class="nav-item has-treeview">
                    <a href="/users/blog-post" class="nav-link">
                        <i class="fas fa-blog"></i>
                        <p>
                            Blog management
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="/show-exam-info" class="nav-link">
                        <i class="fas fa-stream"></i>
                        <p>
                            Job exam info
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/users/quiz-info/list" class="nav-link">
                        <i class="fas fa-poll"></i>
                        <p>Quiz info</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/users/profile" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="nav-link" href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                            <i class="fas fa-power-off"></i>
                            <p>{{ __('Logout') }}</p>

                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
