@include('student.header')

@include('student.navbar')

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

@include('student.footer')
