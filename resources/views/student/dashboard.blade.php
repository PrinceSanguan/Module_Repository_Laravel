<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IVN Module</title>

  <link rel="shortcut icon" href="{{asset('ivn.ico')}}" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
/>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}" />

  <!-- overlayScrollbars -->
  <link
  rel="stylesheet"
  href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}"
/>

<!-- Theme style -->
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}" />

  <!-- Open Graph meta tags -->
 <meta property="og:title" content="IVN Module" />
 <meta property="og:image" content="{{ url(asset('images/ivn.png')) }}" />
 <meta property="og:url" content="http://ivnmodule.free.nf/" />
 <meta property="og:site_name" content="IVN Module" />
 <meta property="og:description" content="IVN Module" />
</head>

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
          <a style="cursor: default;">Hi, Student <strong>{{ ucfirst($user->name) }}!</strong></a>
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
          <a href="{{ route('student.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-pen"></i>
            <p>
              Quizzes
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Modules
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>
              Profile
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">My Dashboard</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!--Main Content Here --->
    <div class="row">

        <!-- Number of Quiz -->
        <div class="col-lg-6 col-12">
          <div class="small-box bg-pink">
            <div class="inner">
              <h3>1/5</h3>

              <p>Answered quizzes</p>
            </div>
            <div class="icon">
              <i class="fas fa-pen"></i>
            </div>
            <a href="#" class="small-box-footer">
             <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Number of Module -->
        <div class="col-lg-6 col-12">
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>2/3</h3>

              <p>Read modules</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">
              <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

    </div>
  <!--/.Main Content Here--->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2024.</strong> All rights reserved of Ms. Ina V Nucup.

    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

 <!-- jQuery -->
 <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
 <!-- Bootstrap -->
 <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- overlayScrollbars -->
 <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
 <!-- AdminLTE App -->
 <script src="{{asset('dist/js/adminlte.js')}}"></script>

</body>
</html>
