@include('student.header')

@include('student.navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">My profile</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!--Main Content Here --->
<div class="row">
  <div class="col-12">
    <div class="card">
      
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">

          <h3 class="profile-username text-center">{{$user->name}}</h3>

          <h4 class="text-muted text-center">{{$user->section}}</h4>

          <p class="text-muted text-center">{{$user->school}}</p>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Number of Quiz -->
      <div class="col-lg-12 col-12">
        <div class="small-box bg-pink">
          <div class="inner">
            <h3>{{$studentResultCount}}/{{$quizTitleCount}}</h3>

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
      <div class="col-lg-12 col-12">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>{{$moduleCount}}</h3>

            <p>Number of Modules</p>
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
    <!-- /.card -->
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


@include('student.footer')
