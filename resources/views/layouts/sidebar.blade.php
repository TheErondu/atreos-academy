<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>

            <!-- Sidebar Content -->

            <a href="index.html" class="sidebar-brand sidebar-brand-dark bg-primary-pickled-bluewood">
                <img src="http://127.0.0.1:8000/images/logo/atreos-logo.png" class="img-fluid" alt="logo"
                    style="height: 64px; width: 165px;">
            </a>
            @can('take courses')
                <div class="sidebar-heading">Student</div>
                <ul class="sidebar-menu">

                    <li class="sidebar-menu-item active">
                        <a class="sidebar-menu-button" href="{{ route('home') }}">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                            <span class="sidebar-menu-text">Home</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('courses.index') }}">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
                            <span class="sidebar-menu-text">Browse Courses</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">search</span>
                            <span class="sidebar-menu-text">My Courses</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{route('tests.index')}">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">timeline</span>
                            <span class="sidebar-menu-text">My Tests</span>
                        </a>
                    </li> --}}
                </ul>
            @endcan
            <div class="sidebar-heading">Instructor</div>
            <ul class="sidebar-menu">

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                        <span class="sidebar-menu-text">Instructor Dashboard</span>
                    </a>
                </li>
                @can('manage courses')
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('courses.index') }}">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
                            <span class="sidebar-menu-text">Manage Courses</span>
                        </a>
                    </li>
                @endcan
                @can('manage enrollments')
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('enrollments.index') }}">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
                            <span class="sidebar-menu-text">Manage Enrollments</span>
                        </a>
                    </li>
                @endcan
                @can('manage tests')
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('tests.index') }}">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">library_books</span>
                            <span class="sidebar-menu-text">Manage Tests</span>
                        </a>
                    </li>
                @endcan
                @can('manage stats')
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('stats.index') }}">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">insert_chart</span>
                            <span class="sidebar-menu-text">Stats and Reports</span>
                        </a>
                    </li>

                </ul>
            @endcan
            <div class="sidebar-heading">Settings</div>
            <ul class="sidebar-menu">
                @can('manage users')
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('employees.index') }}">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">supervisor_account</span>
                            <span class="sidebar-menu-text">Manage employees</span>
                        </a>
                    </li>
                @endcan
                @can('manage roles')
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('roles.index') }}">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">person</span>
                            <span class="sidebar-menu-text">Manage Roles</span>
                        </a>
                    </li>
                @endcan
            </ul>
            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>
