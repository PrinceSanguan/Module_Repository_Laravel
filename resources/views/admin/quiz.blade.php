@include('admin.header')

@include('admin.navbar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Quizzes</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 text-right"> <!-- Moved the button container to the right -->
          <button class="btn btn-sm btn-info" id="addQuizBtn">Add Quiz</button>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main Content Here -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Published By</th>
                <th>Title</th>
                <th>Number of Question</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($data)
                @foreach ($data as $datas)
                  <tr>
                    <td>{{ $datas->id }}</td>
                    <td>{{ $datas->user->name }}</td>
                    <td>{{ $datas->title }}</td>
                    <td>{{ $datas->questions_count }}</td>
                    <td>{{ $datas->created_at->format('F j, Y g:ia') }}</td>
                    <td>
                      <button class="btn btn-sm btn-info addQuestionBtn" data-target="#addQuestionModal" data-quiztitleid="{{ $datas->id }}">Add Question</button>
                      <button class="btn btn-sm btn-warning viewQuestionBtn" data-quiztitleid="{{ $datas->id }}">View</button>
                      <button class="btn btn-sm btn-danger deleteQuizBtn" data-quiztitleid="{{ $datas->id }}">Delete</button>
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
  <!--/.Main Content Here-->
</div>
<!-- /.content-wrapper -->

<!-- Add Quiz Modal -->
<div class="modal fade" id="addQuizModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addQuizModalLabel">Add Quiz</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <!-- Form inside the modal -->
              <form method="post" action="{{route('admin.addQuiz')}}">
                  @csrf
                  <div class="form-group">
                      <label>Quiz Title</label>
                      <input type="text" class="form-control" name="title">
                  </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="saveQuestionBtn">Save</button>
          </div>
          </form>
          <!-- Form inside the modal -->
      </div>
  </div>
</div>
<!-- Add Quiz Modal -->

<!-- Add Question Modal -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQuestionModalLabel">Add Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form inside the modal -->
                <form id="addQuestionForm" method="post" action="{{route('admin.addQuestion')}}">
                  @csrf
                    <div class="form-group">
                      <label>Quiz ID</label>
                      <input type="text" class="form-control" id="quizTitleIdInput" name="quiztitle_id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="question">Question</label>
                        <textarea class="form-control" id="question" name="question" rows="2" placeholder="Enter your question here..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Choices A</label>
                        <input type="text" class="form-control" id="choicesA" name="choicesA" required>
                    </div>
                    <div class="form-group">
                        <label>Choices B</label>
                        <input type="text" class="form-control" id="choicesB" name="choicesB" required>
                    </div>
                    <div class="form-group">
                        <label>Choices C</label>
                        <input type="text" class="form-control" id="choicesC" name="choicesC" required>
                    </div>
                    <div class="form-group">
                        <label>Choices D</label>
                        <input type="text" class="form-control" id="choicesD" name="choicesD" required>
                    </div>
                    <div class="form-group">
                        <label>Choices E</label>
                        <input type="text" class="form-control" id="choicesE" name="choicesE" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveQuestionBtn">Save</button>
            </div>
            </form>
            <!-- Form inside the modal -->
        </div>
    </div>
</div>
<!-- Add Question Modal -->

<!-- View Question Modal -->
<div class="modal fade" id="viewQuestionModal" tabindex="-1" role="dialog" aria-labelledby="viewQuestionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="viewQuestionModalLabel">View Question</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="table-responsive">
                  <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Number</th>
                            <th>Question</th>
                            <th>Choices A</th>
                            <th>Choices B</th>
                            <th>Choices C</th>
                            <th>Choices D</th>
                            <th>Choices E</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>

                          </tr>
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
<!-- View Question Modal -->

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

<!-- JavaScript/jQuery -->
<script>
$(document).ready(function() {
    // Show the modal when Add Question button is clicked
    $('.addQuestionBtn').click(function() {
        var quizTitleId = $(this).data('quiztitleid');
        $('#quizTitleIdInput').val(quizTitleId);
        $('#addQuestionModal').modal('show');
    });

    // Show the question modal when Add Quiz button is clicked
    $('#addQuizBtn').click(function() {
        $('#addQuizModal').modal('show');
    });
});
</script>

<script>
  $(document).ready(function() {
      // Show the question modal when View Question button is clicked
      $(document).on('click', '.viewQuestionBtn', function() {
          // Get the quiz title ID from the button's data attribute
          var quizTitleId = $(this).data('quiztitleid');
          
          // Perform an AJAX request to fetch questions based on the quiz title ID
          $.ajax({
              url: '/admin/quiz/' + quizTitleId,
              type: 'GET',
              success: function(response) {
                  // Clear existing table rows
                  $('#viewQuestionModal tbody').empty();
                  
                  // Loop through the fetched questions and populate the table
                  $.each(response.questions, function(index, question) {
                      var row = '<tr>' +
                                  '<td>' + question.id + '</td>' +
                                  '<td>' + question.question + '</td>' +
                                  '<td>' + question.choicesA + '</td>' +
                                  '<td>' + question.choicesB + '</td>' +
                                  '<td>' + question.choicesC + '</td>' +
                                  '<td>' + question.choicesD + '</td>' +
                                  '<td>' + question.choicesE + '</td>' +
                                '</tr>';
                      $('#viewQuestionModal tbody').append(row);
                  });
                  
                  // Show the modal
                  $('#viewQuestionModal').modal('show');
              },
              error: function(xhr, status, error) {
                  console.error('Error fetching questions:', error);
              }
          });
      });
  });
  </script>

<script>
$(document).ready(function() {
    // Delete quiz title when the "Delete" button is clicked
    $(document).on('click', '.deleteQuizBtn', function() {
        // Get the quiz title ID from the button's data attribute
        var quizTitleId = $(this).data('quiztitleid');

        // Confirm deletion
        var confirmDelete = confirm('Are you sure you want to delete this quiz?');
        
        // Check if deletion is confirmed
        if (confirmDelete) {
            // Send an AJAX request to delete the quiz title
            $.ajax({
                url: '/admin/delete-quiz/' + quizTitleId,
                type: 'GET',
                success: function(response) {
                    // Handle success response
                    alert('Quiz deleted successfully!');
                    
                    // Reload the page
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error deleting quiz:', error);
                    alert('An error occurred while deleting the quiz. Please try again later.');
                }
            });
        }
    });
});
  </script>
  

@include('admin.footer')
