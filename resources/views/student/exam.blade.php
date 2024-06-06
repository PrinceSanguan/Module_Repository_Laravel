@include('student.header')

<div class="container mt-5">
  <div class="card">
    <form method="post" action="{{ route('student.check.answer') }}">
      @csrf
      <div class="card-body">
        <h3 class="card-text">{{ $question->question }}</h3>
        <!-- Display choices for the question -->
        <div class="col-md-6">
            <label>
                <input type="radio" name="answer" value="{{ $question->choicesA }}" required> {{ $question->choicesA }}
            </label><br>
            <label>
                <input type="radio" name="answer" value="{{ $question->choicesB }}" required> {{ $question->choicesB }}
            </label><br>
            <label>
                <input type="radio" name="answer" value="{{ $question->choicesC }}" required> {{ $question->choicesC }}
            </label><br>
            <label>
                <input type="radio" name="answer" value="{{ $question->choicesD }}" required> {{ $question->choicesD }}
            </label><br>
        </div>
    </div>
      <!-- Include the question ID and quiz ID as hidden input fields -->
      <input type="hidden" name="question_id" value="{{ $question->id }}">
      <input type="hidden" name="quiz_id" value="{{ $question->quiztitle_id }}">
      <input type="hidden" name="question_number" value="{{ $questionNumber }}">
      <input type="hidden" name="correct_answer" value="{{ $question->answer }}">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @if ($questionNumber < $totalQuestions)
    <form method="get" action="{{ route('student.exam') }}">
      @csrf
      <input type="hidden" name="quiz_id" value="{{ $question->quiztitle_id }}">
      <input type="hidden" name="question_number" value="{{ $questionNumber + 1 }}">
    </form>
    @endif
  </div>
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

@include('student.footer')
