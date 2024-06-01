@include('student.header')

<div class="container mt-5">
  <div class="card">
    <form method="post" action="{{ route('student.check.answer') }}">
      @csrf
      <div class="card-body">
        <h3 class="card-text">{{ $question->id }}. {{ $question->question }}</h3>
          <!-- Display choices for the question -->
          @foreach(['A', 'B', 'C', 'D', 'E'] as $choice)
          <div class="col-md-6">
              <label>
                  <input type="radio" name="question_{{ $question->id }}" value="{{ $question->{'choices'.$choice} }}" required> {{ $question->{'choices'.$choice} }}
              </label>
          </div>
          @endforeach
      </div>
      <input type="hidden" name="quiz_id" value="{{ $question->quiztitle_id }}">
      <input type="hidden" name="question_number" value="{{ $questionNumber }}">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @if ($questionNumber < $totalQuestions)
    <form method="get" action="{{ route('student.exam') }}">
      @csrf
      <input type="hidden" name="quiz_id" value="{{ $question->quiztitle_id }}">
      <input type="hidden" name="question_number" value="{{ $questionNumber + 1 }}">
      <button type="submit" class="btn btn-secondary">Next Question</button>
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
