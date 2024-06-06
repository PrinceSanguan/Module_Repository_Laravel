@include('admin.header')
@include('admin.navbar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Change Username</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{ $user->name }}</h3>
            <h5 class="widget-user-desc">{{ $user->userType }}</h5>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>

        @if(session('success'))
          <div id="success-alert" class="alert alert-success" style="font-size: 18px; padding: 20px;">
            {{ session('success') }}
          </div>
          <script>
            setTimeout(function() {
              document.getElementById('success-alert').style.display = 'none';
            }, 5000); // (5 seconds)
          </script>
        @endif  

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Change Username</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="POST" action="{{ route('change.usernamerequest') }}">
            @csrf

            <div class="card-body">
              <div class="form-group">
                <label for="current_username">Current Username</label>
                <input type="text" name="current_username" class="form-control" required>
                @error('current_username')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="new_username">New Username</label>
                <input type="text" name="new_username" class="form-control" required>
                @error('new_username')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="confirm_username">Confirm New Username</label>
                <input type="text" name="confirm_username" class="form-control" required>
                @error('confirm_username')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->

@include('admin.footer')
