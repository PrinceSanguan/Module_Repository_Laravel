<body class="hold-transition sidebar-mini">
  <div class="wrapper">
  
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="{{asset('ivn.ico')}}" alt="AdminLTELogo" height="260" width="260">
    </div>
  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark justify-content-start">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item d-sm-inline">
        <a href="{{route('teacher.dashboard')}}" class="nav-link">{{ $user->name }}</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  
  
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a class="brand-link" style="cursor: default;">
        <img src="{{asset('ivn.ico')}}" alt="IVN-LOGO" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">IVN MODULE</span>
      </a>
  
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex"> 
          <div class="info">
            <a style="cursor: default;">Hi, Teacher <strong>{{ ucfirst($user->name) }}!</strong></a>
          </div>
        </div>
  
       <!-- Sidebar Menu -->
       <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
  
           <li class="nav-item">
            <a href="{{ route('teacher.dashboard') }}" class="nav-link {{ Route::is('teacher.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
  
          <li class="nav-item">
            <a href="{{ route('teacher.student') }}" class="nav-link {{ Route::is('teacher.student') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Students
              </p>
            </a>
          </li>
  
          <li class="nav-item">
            <a href="{{route('teacher.quiz')}}" class="nav-link {{ Route::is('teacher.quiz') ? 'active' : '' }}">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Quiz
              </p>
            </a>
          </li>
  
           <li class="nav-item">
            <a href="{{route('teacher.module')}}" class="nav-link {{ Route::is('teacher.module') ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Module
              </p>
            </a>
          </li> 
  
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>