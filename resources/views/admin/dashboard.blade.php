@include('admin.header')

@include('admin.navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!--Main Content Here --->
    <div class="row">

      <!-- Number of Students -->
      <div class="col-lg-6 col-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{$totalNumberOfStudent}}</h3>

            <p>Number of students</p>
          </div>
          <div class="icon">
            <i class="fas fa-user"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- Number of Teacher -->
      <div class="col-lg-6 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$totalNumberOfTeacher}}</h3>

            <p>Number of teachers</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-tie"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

        <!-- Number of Quiz -->
        <div class="col-lg-6 col-6">
          <div class="small-box bg-pink">
            <div class="inner">
              <h3>{{$totalNumberOfQuiz}}</h3>

              <p>Number of quizzes</p>
            </div>
            <div class="icon">
              <i class="fas fa-pen"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Number of Module -->
        <div class="col-lg-6 col-6">
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>4</h3>

              <p>Number of modules</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Pending Account -->
        <div class="col-lg-12 col-12">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$totalNumberOfPendingAccounts}}</h3>

              <p>Pending Accounts</p>
            </div>
            <div class="icon">
              <i class="fas fa-question"></i>
            </div>
            <a href="{{route('admin.pending')}}" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
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

@include('admin.footer')
