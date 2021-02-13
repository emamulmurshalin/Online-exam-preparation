<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{asset('admin/dist/img/logo.png')}}" alt="Online job preparation" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Online job</span>
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
                    <router-link to="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </router-link>
                </li>
                @can('isAdmin')
                <li class="nav-item">
                    <router-link to="/users/list/view" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Users</p>
                    </router-link>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-question-circle"></i>
                        <p>
                            Question management
                            <i class="fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/show-question" class="nav-link">
                                <p>Show question</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/add-previous-question" class="nav-link">
                                <p>Add previous question</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-align-center"></i>
                        <p>
                            Quiz management
                            <i class="fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/quiz/list/view" class="nav-link">
                                <p>All quiz</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/add-quiz-question" class="nav-link">
                                <p>Add quiz question</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/add-quiz" class="nav-link">
                                <p>Add quiz option</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/add-quiz-answer" class="nav-link">
                                <p>Add quiz answer</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <router-link to="/users/contact-info" class="nav-link">
                        <i class="fas fa-envelope-open-text"></i>
                        <p>Contact info</p>
                    </router-link>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-blog"></i>
                        <p>
                            Blog management
                            <i class="fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/users/blog-post" class="nav-link">
                                <p>All blog</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/users/add-post" class="nav-link">
                                <p>Add post</p>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-stream"></i>
                        <p>
                            Job exam info
                            <i class="fas fa-angle-down"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/show-exam-info" class="nav-link">
                                <p>Show exam info</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/add-exam-info" class="nav-link">
                                <p>Add exam info</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                @endcan
                <li class="nav-item">
                    <router-link to="/users/profile" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>Profile</p>
                    </router-link>
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
