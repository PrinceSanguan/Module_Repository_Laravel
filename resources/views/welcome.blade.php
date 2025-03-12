<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVN Module</title>

    <link rel="shortcut icon" href="{{ asset('ivn.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

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
                    <img class="svg-img" src="{{ asset('ivn.ico') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 d-flex main-content">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="mb-4">
                                <h2 class="display-3 text-center">SCHOOL MODULE<span style="color: #AD50A7;"></span>
                                </h2>
                                <p class="mb-4">
                                    To access this website, you must contact <strong class="text-dark">Ms. Teacher
                                        Ganda</strong>. If you do not have an account, please <a
                                        href="{{ route('signup') }}">click here</a>.
                                </p>
                            </div>

                            @if (session('error'))
                                <div id="error-alert" class="alert alert-danger"
                                    style="font-size: 18px; padding: 20px;">
                                    {{ session('error') }}
                                </div>
                                <script>
                                    setTimeout(function() {
                                        document.getElementById('error-alert').style.display = 'none';
                                    }, 3000);
                                </script>
                            @endif

                            @if (session('success'))
                                <div id="success-alert" class="alert alert-success"
                                    style="font-size: 18px; padding: 20px;">
                                    {{ session('success') }}
                                </div>
                                <script>
                                    setTimeout(function() {
                                        document.getElementById('success-alert').style.display = 'none';
                                    }, 5000);
                                </script>
                            @endif

                            <form action="{{ route('login.post') }}" method="post">
                                @csrf

                                <div class="form-group first">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username">

                                </div>

                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password">

                                </div>

                                <input type="submit" value="Log In" class="btn text-white btn-block">

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    @include('footer')
