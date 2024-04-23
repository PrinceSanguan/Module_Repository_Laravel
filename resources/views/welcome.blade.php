@include('header')

<main class="main" style="min-height: 100vh; background: url('{{ asset('images/background.jpg') }}'); background-size:cover; background-position:center; transition: .3s ease; pointer-events: auto;">
  <header class="header">
    <a href="#" class="logo">IVN MODULE</a>

    <nav class="navbar">
{{--       <a href="#" class="active">Home</a>
      <a href="#">About</a>
      <a href="#">Services</a>
      <a href="#">Contact</a> --}}
    </nav>

  </header>

<div class="container">
  <section class="quiz-section">
    <div class="quiz-box">
      <h1>Module</h1>
      <div class="quiz-header">
        <span>Quiz Website</span>
        <span class="header-score">Score: 0 / 5</span>
      </div>

      <div class="question-image">
        
      </div>

      <h2 class="question-text"></h2>

      <div class="option-list">

      </div>

      <div class="quiz-footer">
        <span class="question-total">1 of 5 Questions</span>
        <button class="next-btn">Next</button>
      </div>

    </div>

    <div class="result-box">
      <h2>Quiz Result!</h2>
      <div class="percentage-container">
        <div class="circular-progress">
          <span class="progress-value">0%</span>
        </div>

        <span class="score-text">Your Score 0 out of 5</span>
      </div>
      <div class="buttons">
        <button class="tryAgain-btn">Try Again</button>
        <button class="goHome-btn">Go to Home</button>
      </div>
    </div>

  </section>



  <section class="home">
    <div class="home-content">
      <h1>IVN Module</h1>
      <p>This web-based module is for grade 3 learners to assist them their weekly learning task.</p>
      <button class="start-btn">Start Quiz</button>
    </div>
  </section>
</div>

</main>

<div class="popup-info">
  <h2>Quiz Guide</h2>
  <span class="info">This Quiz is intended for all the grade three learners.</span>


<div class="btn-group">
  <button class="info-btn exit-btn">Exit Quiz</button>
  <a href="#" class="info-btn continue-btn">Continue</a>
</div>

</div>

<script src="{{asset('js/question.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
@include('footer')

