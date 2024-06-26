@include('admin.header')

@include('admin.navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List of Pending</h1>
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
        @if ($data->isEmpty())
        <div class="callout callout-info">
          <h5><i class="fas fa-info"></i> Note:</h5>
          No Pending Account!
        </div>
        @else
          <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Section</th>
                    <th>School</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $datas)
                <tr>
                    <td>{{ $datas->id }}</td>
                    <td>{{ $datas->username }}</td>
                    <td>{{ $datas->name }}</td>
                    <td>{{ $datas->userType }}</td>
                    <td>{{ $datas->section }}</td>
                    <td>{{ $datas->school }}</td>
                    <td>{{ $datas->created_at->format('F j, Y g:ia') }}</td>

                    <td>
                      <button class="btn btn-sm btn-success activate-btn" data-id="{{ $datas->id }}">Activate</button>
                      <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $datas->id }}">Delete</button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
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

<script>
  $(document).ready(function() {
      // Activate button click event
      $('.activate-btn').click(function() {
          var userId = $(this).data('id');
          $.ajax({
              type: 'POST',
              url: '/admin/pending/' + userId + '/activate',
              data: {
                  _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                  // Handle success response
                  alert('User activated successfully.');
                  location.reload(); // Refresh the page after successful activation
              },
              error: function(xhr, status, error) {
                  // Handle error response
                  alert('Error: ' + xhr.responseText);
              }
          });
      });

      // Delete button click event
      $('.delete-btn').click(function() {
          var userId = $(this).data('id');
          $.ajax({
              type: 'POST',
              url: '/admin/pending/' + userId + '/delete',
              data: {
                  _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                  // Handle success response
                  alert('User deleted successfully.');
                  location.reload(); // Refresh the page after successful deletion
              },
              error: function(xhr, status, error) {
                  // Handle error response
                  alert('Error: ' + xhr.responseText);
              }
          });
      });
  });
</script>

@include('admin.footer')