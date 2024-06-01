@include('student.header')

<div class="container mt-5">
  <div class="card">
    <form method="post" action="{{route('student.check.answer')}}">
      @csrf
      @foreach ($questions as $question)
          <div class="card">
              <div class="card-body">
                <h3 class="card-text">{{ $question->id }}. {{ $question->question }}</h3>
                  <!-- Display choices for the question -->
                  <div class="col-md-6">
                      <label>
                          <input type="radio" name="question_{{ $question->id }}" value="{{ $question->choicesA }}" required> {{ $question->choicesA }}
                      </label>
                  </div>
                  <div class="col-md-6">
                      <label>
                          <input type="radio" name="question_{{ $question->id }}" value="{{ $question->choicesB }}" required> {{ $question->choicesB }}
                      </label>
                  </div>
                  <div class="col-md-6">
                      <label>
                          <input type="radio" name="question_{{ $question->id }}" value="{{ $question->choicesC }}" required> {{ $question->choicesC }}
                      </label>
                  </div>
                  <div class="col-md-6">
                      <label>
                          <input type="radio" name="question_{{ $question->id }}" value="{{ $question->choicesD }}" required> {{ $question->choicesD }}
                      </label>
                  </div>
                  <div class="col-md-6">
                      <label>
                          <input type="radio" name="question_{{ $question->id }}" value="{{ $question->choicesE }}" required> {{ $question->choicesE }}
                      </label>
                  </div>
              </div>
          </div>
      @endforeach
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
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
