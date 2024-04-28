@include('admin.header')

@include('admin.navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List of Student</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!--Main Content Here --->
<div class="row">
  <div class="col-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Name</th>
              <th>Date Created</th>
              <th>Action</th> <!-- New column for actions -->
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>183</td>
              <td>John Doe</td>
              <td>11-7-2014</td>
              <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
              <td>
                <button class="btn btn-sm btn-info" onclick="viewRow()">View</button>
                <button class="btn btn-sm btn-danger" onclick="deleteRow(this)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
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

@include('admin.footer')