@include('admin.header')

@include('admin.navbar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Module</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 text-right"> <!-- Moved the button container to the right -->
          <button class="btn btn-sm btn-info" id="addModuleBtn">Add Module</button>
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
                <th>Number</th>
                <th>Published By</th>
                <th>Title</th>
                <th>Number of Module Content</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @if ($modules)
                @php $count = 1; @endphp <!-- Initialize count variable -->
                @foreach ($modules as $module)
                <tr>
                    <td>{{ $count++ }}</td> <!-- Increment count for each iteration -->
                    <td>{{ $module->user->name }}</td>
                    <td>{{ $module->title }}</td>
                    <td>{{ $module->modulecontent_count }}</td>
                    <td>{{ $module->created_at->format('F j, Y g:ia') }}</td>
                    <td>
                        <button class="btn btn-sm btn-info uploadModuleBtn" data-moduleid="{{ $module->id }}">Upload</button>
                        <button class="btn btn-sm btn-warning viewModuleBtn" data-moduleid="{{ $module->id }}">View</button>
                        <button class="btn btn-sm btn-danger deleteModuleBtn" data-moduleid="{{ $module->id }}">Delete</button>
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

<!-- Add Module Modal -->
<div class="modal fade" id="addModuleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addmoduleModalLabel">Add Module</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <!-- Form inside the modal -->
              <form method="post" action="{{route('admin.addModule')}}">
                  @csrf
                  <div class="form-group">
                      <label>Module Title</label>
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
<!-- Add Module Modal -->

<!-- View Module Modal -->
<div class="modal fade" id="viewModuleModal" tabindex="-1" role="dialog" aria-labelledby="viewModuleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="viewModuleModalLabel">View Module</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div id="moduleCarousel" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                      <!-- Carousel items will be dynamically added here -->
                  </div>
                  <a class="carousel-control-prev" href="#moduleCarousel" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#moduleCarousel" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                  </a>
                  <!-- Page numbering -->
                  <div class="carousel-page-number text-center mt-2"></div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
<!-- View Module Modal -->

<!-- Upload Module Modal -->
<div class="modal fade" id="uploadModuleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="uploadModuleModalLabel">Upload your Lesson</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <!-- Form inside the modal -->
            <form method="post" action="{{ route('admin.addImage') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="module_id" id="moduleID" readonly>
                <input type="file" name="files[]" required multiple> <!-- Note the '[]' after the name attribute -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveQuestionBtn">Save</button>
                </div>
            </form>
            <!-- Form inside the modal -->
      </div>
  </div>
</div>
<!-- View Upload Modal -->


<script>
  $(document).ready(function() {
      // Show the Module modal when Add Module button is clicked
      $('#addModuleBtn').click(function() {
          $('#addModuleModal').modal('show');
      });

      // Show the Module form for upload when upload button is clicked
      $('.uploadModuleBtn').click(function() {
          var moduleID = $(this).data('moduleid');
          $('#moduleID').val(moduleID); // Set the Module ID in the hidden input field
          $('#uploadModuleModal').modal('show');
      });

      // View the Module Content
      $('.viewModuleBtn').click(function() {
          $('#viewModuleModal').modal('show');
      });
  });
</script>

<!-- Include PDF.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>

<script>
  $(document).ready(function() {
      var totalModules = 0;
      var currentModuleIndex = 0;

      // Show the Module modal when View Modal button is clicked
      $(document).on('click', '.viewModuleBtn', function() {
          var moduleId = $(this).data('moduleid');

          // Perform an AJAX request to fetch images based on the module ID
          $.ajax({
              url: '/admin/module/' + moduleId,
              type: 'GET',
              success: function(response) {
                  totalModules = response.modules.length;
                  currentModuleIndex = 0;

                  // Clear existing carousel items
                  $('#moduleCarousel .carousel-inner').empty();

                  // Loop through the fetched images and populate the carousel
                  $.each(response.modules, function(index, module) {
                      var extension = module.image.split('.').pop().toLowerCase();
                      var item = $('<div class="carousel-item">');

                      if (extension === 'jpg' || extension === 'png') {
                          item.append($('<img class="d-block w-100" alt="Module Image">').attr('src', "{{ asset('upload-image/') }}/" + module.image));
                      } else if (extension === 'pdf') {
                          var pdfUrl = "{{ asset('upload-image/') }}/" + module.image;
                          var canvas = $('<canvas class="d-block w-100">')[0];
                          item.append(canvas);

                          // Use PDF.js to render the PDF to the canvas
                          var loadingTask = pdfjsLib.getDocument(pdfUrl);
                          loadingTask.promise.then(function(pdf) {
                              pdf.getPage(1).then(function(page) {
                                  var viewport = page.getViewport({ scale: 1.5 });
                                  canvas.height = viewport.height;
                                  canvas.width = viewport.width;
                                  var renderContext = {
                                      canvasContext: canvas.getContext('2d'),
                                      viewport: viewport
                                  };
                                  page.render(renderContext);
                              });
                          });
                      } else {
                          item.append($('<div class="d-block w-100 text-center">No image available</div>'));
                      }

                      // Add active class to the first item
                      if (index === 0) {
                          item.addClass('active');
                      }

                      $('#moduleCarousel .carousel-inner').append(item);
                  });

                  // Update page numbering
                  updatePageNumber();

                  // Show the modal
                  $('#viewModuleModal').modal('show');
              },
              error: function(xhr, status, error) {
                  console.error('Error fetching modules:', error);
              }
          });
      });

      // Update page numbering
      function updatePageNumber() {
          var pageNumberText = (currentModuleIndex + 1) + ' out of ' + totalModules;
          $('.carousel-page-number').text(pageNumberText);

          // Disable next button if on the last page
          if (currentModuleIndex === totalModules - 1) {
              $('.carousel-control-next').addClass('disabled');
          } else {
              $('.carousel-control-next').removeClass('disabled');
          }
      }

      // Handle carousel slide event
      $('#moduleCarousel').on('slid.bs.carousel', function() {
          currentModuleIndex = $('#moduleCarousel .carousel-item.active').index();
          updatePageNumber();
      });

      // Handle next button click
      $('.carousel-control-next').click(function() {
          if (currentModuleIndex < totalModules - 1) {
              currentModuleIndex++;
              $('#moduleCarousel').carousel('next');
          } else {
              $('#viewModuleModal').modal('hide');
          }
      });

      // Handle previous button click
      $('.carousel-control-prev').click(function() {
          if (currentModuleIndex > 0) {
              currentModuleIndex--;
              $('#moduleCarousel').carousel('prev');
          }
      });
  });
</script>


<script>
  $(document).ready(function() {
      // Delete module title when the "Delete" button is clicked
      $(document).on('click', '.deleteModuleBtn', function() {
          // Get the module title ID from the button's data attribute
          var moduleId = $(this).data('moduleid');
  
          // Confirm deletion
          var confirmDelete = confirm('Are you sure you want to delete this module?');
          
          // Check if deletion is confirmed
          if (confirmDelete) {
              // Send an AJAX request to delete the quiz title
              $.ajax({
                  url: '/admin/delete-module/' + moduleId,
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
                      alert('An error occurred while deleting the module. Please try again later.');
                  }
              });
          }
      });
  });
  </script>

@include('admin.footer')
