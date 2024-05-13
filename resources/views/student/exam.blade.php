@include('student.header')

<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      Question 1:
    </div>
    <div class="card-body">
      <p class="card-text">What is the capital of France?</p>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="question1" id="option1" value="option1">
        <label class="form-check-label" for="option1">Paris</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="question1" id="option2" value="option2">
        <label class="form-check-label" for="option2">Rome</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="question1" id="option3" value="option3">
        <label class="form-check-label" for="option3">Berlin</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="question1" id="option4" value="option4">
        <label class="form-check-label" for="option4">Madrid</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="question1" id="option5" value="option5">
        <label class="form-check-label" for="option5">London</label>
      </div>
    </div>
    <div class="card-footer text-muted">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</div>

@include('student.footer')