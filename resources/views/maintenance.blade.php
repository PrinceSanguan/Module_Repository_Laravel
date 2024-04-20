<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IVN Module</title>

  <link rel="shortcut icon" href="{{asset('ivn.ico')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('maintenance/mdb.min.css')}}"/>

  <!--- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css" />
      <!-- Google Fonts Roboto -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

   <!-- Open Graph meta tags -->
 <meta property="og:title" content="IVN Module" />
 <meta property="og:image" content="{{ url(asset('images/ivn.png')) }}" />
 <meta property="og:url" content="http://ivnmodule.free.nf/" />
 <meta property="og:site_name" content="IVN Module" />
 <meta property="og:description" content="IVN Module" />
</head>

<body>
  <!--Main Navigation-->
  <header>
    <!-- Intro settings -->
    <style>
      /* Default height for small devices */
      #intro {
        height: 600px;
        /* Margin to fix overlapping fixed navbar */
        margin-top: 58px;
      }
      @media (max-width: 991px) {
              #intro {
              /* Margin to fix overlapping fixed navbar */
              margin-top: 45px;
      	}
      }
    </style>

    <!-- Background image -->
    <div id="intro" class="p-5 text-center bg-image shadow-1-strong"
      style="background-image: url('https://mdbootstrap.com/img/new/slides/205.jpg');">
      <div class="mask" style="background-color: rgba(0, 0, 0, 0.7);">
        <div class="d-flex justify-content-center align-items-center h-100">
          <div class="text-white px-4" data-mdb-theme="dark">
            <h1 class="mb-3">Coming Soon!</h1>

            <!-- Time Counter -->
            <h3 id="time-counter" class="border border-light my-4 p-4"></h3>

            <p>We're working hard to finish the development of this site and launch it on April 28, 2024, at 12:00 PM.</p>
            <p>The website is currently under construction by Ms. Aina Ainz.</p>
            
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
  </header>
  <!--Main Navigation-->


  <!--Footer-->
  <footer class="bg-light text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2024 Copyright:
      <a class="text-dark" href="https://prince-sanguan.free.nf">PES</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!--Footer-->

<!-- Time Counter -->
<script type="text/javascript">
  // Set the date we're counting down to
  var countDownDate = new Date("April 28, 2024 12:00:00").getTime();

  // Update the count down every 1 second
  var x = setInterval(function () {
    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now an the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="time-counter"
    document.getElementById('time-counter').innerHTML =
      days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's ';

    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById('time-counter').innerHTML = 'EXPIRED';
    }
  }, 1000);
</script>
<!-- MDB -->
<script type="text/javascript" src="{{asset('maintenance/mdb.umd.min.js')}}"></script>

</body>
</html>