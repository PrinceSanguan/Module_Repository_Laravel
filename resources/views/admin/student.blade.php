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
                </div>
            </div>
        </div>
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
                                <th>Name</th>
                                <th>Section</th>
                                <th>School</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data)
                                @foreach ($data as $datas)
                                    <tr>
                                        <td>{{ $datas->name }}</td>
                                        <td>{{ $datas->section }}</td>
                                        <td>{{ $datas->school }}</td>
                                        <td>{{ $datas->created_at->format('F j, Y g:ia') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewModal" data-id="{{ $datas->id }}">View Result</button>
                                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $datas->id }}">Delete</button>
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
    <strong>Copyright &copy; 2024.</strong> All rights reserved of Ms. Ina V Nucup.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.1.0
    </div>
</footer>

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Quiz Result</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                      <thead>
                          <tr>
                              <th>Quiz Title</th>
                              <th>Prepared by:</th>
                              <th>Number of Questions</th>
                              <th>Date Prepared</th>
                              <th>Result</th>
                          </tr>
                      </thead>
                      <tbody id="modalTableBody">
                          <!-- Dynamic content will be injected here -->
                      </tbody>
                  </table>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<!-- Ensure you have jQuery and Bootstrap JS included -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- CSRF Token Setup for AJAX -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<!-- Custom JavaScript to handle the modal trigger and AJAX request -->
<script>
  $(document).ready(function() {
      $('#viewModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var dataId = button.data('id'); // Extract info from data-* attributes
          var modal = $(this);

          // Clear previous content
          modal.find('#modalTableBody').html('');

          // Send AJAX request to the backend
          $.ajax({
              url: '/admin/student/' + dataId, // Your route to the backend function
              method: 'GET',
              success: function(response) {
                  console.log(response);
                  // Set the modal title with the fetched student name
                  modal.find('.modal-title').text(response.studentName + ' Quiz Result');

                  // Update the modal content with the response if needed
                  if (response.studentResults && response.quiz) {
                      var resultsHtml = '';
                      response.quiz.forEach(function(quiz) {
                          var resultHtml = '';
                          response.studentResults.forEach(function(result) {
                              if (result.quiztitle_id === quiz.id) {
                                  // Format result.created_at similar to quiz.created_at
                                  var resultCreatedAt = new Date(result.created_at);
                                  var formattedResultDate = resultCreatedAt.toLocaleString('en-US', {
                                      month: 'long',
                                      day: 'numeric',
                                      year: 'numeric',
                                      hour: 'numeric',
                                      minute: 'numeric',
                                      hour12: true
                                  });

                                  resultHtml = 'Score: ' + result.score + '/' + quiz.questions.length +
                                               '<br>Status: ' + result.availability +
                                               '<br>Date Taken: ' + formattedResultDate;
                              }
                          });

                          // Convert quiz.created_at date to the desired format
                          var createdAt = new Date(quiz.created_at);
                          var formattedDate = createdAt.toLocaleString('en-US', {
                              month: 'long',
                              day: 'numeric',
                              year: 'numeric',
                              hour: 'numeric',
                              minute: 'numeric',
                              hour12: true
                          });

                          resultsHtml += '<tr>' +
                              '<td>' + quiz.title + '</td>' +
                              '<td>' + quiz.user.name + '</td>' +
                              '<td>' + quiz.questions.length + '</td>' +
                              '<td>' + formattedDate + '</td>' +
                              '<td>' + resultHtml + '</td>' +
                              '</tr>';
                      });

                      modal.find('#modalTableBody').html(resultsHtml);
                  } else {
                      modal.find('#modalTableBody').html('<tr><td colspan="5">No results found for this student.</td></tr>');
                  }
              },
              error: function(xhr) {
                  console.log('Error:', xhr.responseText);
                  modal.find('#modalTableBody').html('<tr><td colspan="5">An error occurred while fetching data.</td></tr>');
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
