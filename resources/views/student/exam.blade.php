@include('student.header')

<div class="container mt-5">
  <div class="card">
    @foreach ($questions as $question)
      <div class="card">
          <div class="card-body">
              <p class="card-text">{{ $question->question }}</p>
              <!-- Display choices for the question -->
              <ul>
                  <li>{{ $question->choicesA }}</li>
                  <li>{{ $question->choicesB }}</li>
                  <li>{{ $question->choicesC }}</li>
                  <li>{{ $question->choicesD }}</li>
                  <li>{{ $question->choicesE }}</li>
              </ul>
              <!-- Display answer for the question -->
              <p>Answer: {{ $question->answer }}</p>
          </div>
      </div>
    @endforeach 
  </div>
</div>

@include('student.footer')