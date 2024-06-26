<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IVN Module</title>

  <link rel="shortcut icon" href="{{asset('ivn.ico')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/welcome.css')}}"> 

  <!--- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

   <!-- Open Graph meta tags -->
 <meta property="og:title" content="IVN Module" />
 <meta property="og:image" content="{{ url(asset('images/ivn.png')) }}" />
 <meta property="og:url" content="http://ivnmodule.free.nf/" />
 <meta property="og:site_name" content="IVN Module" />
 <meta property="og:description" content="IVN Module" />
</head>


<body>

    <div class="page d-flex justify-content-center">
        <div class="container bg-light">
            <div class="row main-row">
                <div class="col-md-6 d-flex main-svg">
                    <img class="svg-img" src="{{asset('ivn.ico')}}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 d-flex main-content">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="mb-4">
                                <h2 class="display-3 text-center">IVN MODULE<span style="color: #AD50A7;"></span></h2>
                            </div>
  
                            @if(session('error'))
                            <div id="error-alert" class="alert alert-danger" style="font-size: 18px; padding: 20px;">
                                {{ session('error') }}
                            </div>
                            <script>
                              setTimeout(function() {
                                  document.getElementById('error-alert').style.display = 'none';
                              }, 3000);
                            </script>
                            @endif
  
                            @if(session('success'))
                            <div id="success-alert" class="alert alert-success" style="font-size: 18px; padding: 20px;">
                                {{ session('success') }}
                            </div>
                            <script>
                                setTimeout(function() {
                                    document.getElementById('success-alert').style.display = 'none';
                                }, 5000);
                            </script>
                            @endif
  
                            <form action="{{route('signup.form')}}" method="post">
                              @csrf
                          
                              <div class="form-group">
                                  <label for="username">Unique Username</label>
                                  <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                                  @error('username')
                                      <div class="text-danger">{{ $message }}</div>
                                  @enderror
                              </div>
                          
                              <div class="form-group">
                                  <label for="password">Password</label>
                                  <input type="password" class="form-control" name="password" required>
                                  @error('password')
                                      <div class="text-danger">{{ $message }}</div>
                                  @enderror
                              </div>
                          
                              <div class="form-group">
                                  <label for="password">Retype Password</label>
                                  <input type="password" class="form-control" name="password_confirmation" required>
                                  @error('password_confirmation')
                                      <div class="text-danger">{{ $message }}</div>
                                  @enderror
                              </div>
                          
                              <div class="form-group">
                                  <label for="username">Full Name</label>
                                  <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                  @error('name')
                                      <div class="text-danger">{{ $message }}</div>
                                  @enderror
                              </div>
  
                              <div class="form-group">
                                  <label for="userType">Type of User</label>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <label>
                                              <input type="radio" name="userType" value="student" {{ old('userType') == 'student' ? 'checked' : '' }} required> Student
                                          </label>
                                      </div>
                                      <div class="col-md-6">
                                          <label>
                                              <input type="radio" name="userType" value="teacher" {{ old('userType') == 'teacher' ? 'checked' : '' }} required> Teacher
                                          </label>
                                      </div>
                                  </div>
                                  @error('userType')
                                      <div class="text-danger">{{ $message }}</div>
                                  @enderror
                              </div> 
  
                              <div class="form-group" id="school-group" style="display: none;">
                                  <label for="school" id="school-label">School</label>
                                  <select class="form-control" name="school" required>
                                      <option value="">Select School</option>
                                      <option value="Tacondo Elementary School">Tacondo Elementary School</option>
                                      <option value="Anunas Elementary School">Anunas Elementary School</option>
                                      <option value="Sta. Teresita Elementary School">Sta. Teresita Elementary School</option>
                                      <option value="Air Force City Elementary School">Air Force City Elementary School</option>
                                      <option value="Don Pepe Henson Elementary School">Don Pepe Henson Elementary School</option>
                                      <option value="M. Nepo Elementary School">M. Nepo Elementary School</option>
                                      <option value="Leoncia Village Elementary School">Leoncia Village Elementary School</option>
                                      <option value="Salapungan Elementary School">Salapungan Elementary School</option>
                                      <option value="Sta. Maria Elementary School">Sta. Maria Elementary School</option>
                                      <option value="Virgin Delos Remedios Elementary School">Virgin Delos Remedios Elementary School</option>
                                      <option value="Cuayan Elementary School">Cuayan Elementary School</option>
                                      <option value="Pampang Elementary School">Pampang Elementary School</option>
                                  </select>
                                  @error('school')
                                      <div class="text-danger">{{ $message }}</div>
                                  @enderror
                              </div>
                          
                              <div class="form-group" id="section-group" style="display: none;">
                                  <label for="section" id="section-label">Section</label>
                                  <select class="form-control" name="section" required>
                                      <option value="">Select Section</option>
                                      <option value="Section 1">Section 1</option>
                                      <option value="Section 2">Section 2</option>
                                      <option value="Section 3">Section 3</option>
                                      <option value="Section 4">Section 4</option>
                                      <option value="Section 5">Section 5</option>
                                      <option value="Section 6">Section 6</option>
                                      <option value="Section 7">Section 7</option>
                                  </select>
                                  @error('section')
                                      <div class="text-danger">{{ $message }}</div>
                                  @enderror
                              </div>
                          
                              <input type="submit" value="Submit" class="btn text-white btn-block">
                          </form>
  
                        </div>
                    </div>
  
                </div>
            </div>
        </div>
    </div>
  
    <script>
      $(document).ready(function() {
          $('input[name="userType"]').change(function() {
              if ($(this).val() == 'student') {
                  $('#school-group').show();
                  $('#section-group').show();
                  $('#school-label').text('School');
                  $('#section-label').text('Section');
              } else if ($(this).val() == 'teacher') {
                  $('#school-group').show();
                  $('#section-group').show();
                  $('#school-label').text('What school do you handle?');
                  $('#section-label').text('What section do you handle?');
              }
          });
      });
    </script>

@include('footer')