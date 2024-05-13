@include('student.header')

@include('student.navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Quizzes</h1>
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
              <th>Quiz Title</th>
              <th>Prepared by:</th>
              <th>Number of Question:</th>
              <th>Date Prepared:</th>
              <th>Status:</th>
              <th>Score:</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if ($quiz)
              @foreach ($quiz as $quizzes)
                <tr>
                  <td>{{ $quizzes->title }}</td>
                  <td>{{ $quizzes->user->name }}</td>
                  <td>{{ $quizzes->questions->count() }}</td>
                  <td>{{ $quizzes->created_at->format('F j, Y g:ia') }}</td>
                  <td>Taken</td>
                  <td>2/2</td>
                  <td>
                    <button class="btn btn-sm btn-info studentExamBtn"> Take the quiz</button>
                  </td>
                </tr>
              @endforeach  
            @endif
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

<script>
  $(document).ready(function() {
    $('.studentExamBtn').click(function() {
      $.ajax({
        url: "{{ route('student.exam') }}",
        type: 'GET',
        success: function(response) {
          window.location.href = "{{ route('student.exam') }}";
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
        }
      });
    });
  });
</script>

@include('student.footer')