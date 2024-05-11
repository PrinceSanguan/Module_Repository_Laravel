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
                <th>ID</th>
                <th>Published By</th>
                <th>Title</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($modules)
                @foreach ($modules as $module)
                    <tr>
                      <td>{{$module->id}}</td>
                      <td>{{ $module->user->name }}</td>
                      <td>{{$module->title}}</td>
                      <td>{{ $module->created_at->format('F j, Y g:ia') }}</td>
                      <td>
                        <button class="btn btn-sm btn-info uploadModuleBtn" data-moduleid="{{ $module->id }}">Upload</button>
                        <button class="btn btn-sm btn-danger vieModuleModal">Delete</button>
                        <button class="btn btn-sm btn-danger deleteQuizBtn">Delete</button>
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

<!-- Upload Module -->
<div class="modal fade" id="uploadModuleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="uploadModuleModalLabel">upload Only A Powerpoint</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <!-- Form inside the modal -->
              <form method="post" action="{{route('admin.addImage')}}" enctype="multipart/form-data" >
                @csrf
                <input type="text" name="module_id" id="moduleID" readonly>
                <input type="file" name="file" required>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveQuestionBtn">Save</button>
                </div>
            </form>
          <!-- Form inside the modal -->
      </div>
  </div>
</div>
<!-- Upload Module -->

<!-- View Carousel Modal -->
<div class="modal fade" id="viewModuleModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
         <!-- carousel -->
        <div
             id='carouselExampleIndicators'
             class='carousel slide'
             data-ride='carousel'
             >
          <ol class='carousel-indicators'>
            <li
                data-target='#carouselExampleIndicators'
                data-slide-to='0'
                class='active'
                ></li>
            <li
                data-target='#carouselExampleIndicators'
                data-slide-to='1'
                ></li>
            <li
                data-target='#carouselExampleIndicators'
                data-slide-to='2'
                ></li>
          </ol>
          <div class='carousel-inner'>
            <div class='carousel-item active'>
              <img class='img-size' src='https://images.unsplash.com/photo-1485470733090-0aae1788d5af?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1391&q=80' alt='First slide' />
            </div>
            <div class='carousel-item'>
              <img class='img-size' src='https://images.unsplash.com/photo-1491555103944-7c647fd857e6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80' alt='Second slide' />
            </div>
            <div class='carousel-item'>
              <img class='img-size' src='https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80' alt='Second slide' />
            </div>
          </div>
          <a
             class='carousel-control-prev'
             href='#carouselExampleIndicators'
             role='button'
             data-slide='prev'
             >
            <span class='carousel-control-prev-icon'
                  aria-hidden='true'
                  ></span>
            <span class='sr-only'>Previous</span>
          </a>
          <a
             class='carousel-control-next'
             href='#carouselExampleIndicators'
             role='button'
             data-slide='next'
             >
            <span
                  class='carousel-control-next-icon'
                  aria-hidden='true'
                  ></span>
            <span class='sr-only'>Next</span>
          </a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- View Carousel Modal -->

<script>
  $(document).ready(function() {
      // Show the Module modal when Add Module button is clicked
      $('#addModuleBtn').click(function() {
          $('#addModuleModal').modal('show');
      });
  });
  </script>

<script>
  $(document).ready(function() {
    // Show the Module form for upload when upload button is clicked
    $('.uploadModuleBtn').click(function() {
      var moduleID = $(this).data('moduleid');
      $('#moduleID').val(moduleID); // Set the Module ID in the hidden input field
      $('#uploadModuleModal').modal('show');
    });
  });
</script>

{{-- <script>
  $(document).ready(function() {
    $('#viewModuleBtn').click(function() {
      $('#viewModuleModal').modal('show');
    });
  });
</script>
 --}}
@include('admin.footer')
