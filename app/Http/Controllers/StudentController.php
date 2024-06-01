<?php

namespace App\Http\Controllers;

use App\Models\QuizTitle;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    private function getUserInfo()
    {
        // Get the currently authenticated user
        $authenticatedUser = Auth::user();
    
        // Check if the authenticated user exists
        if (!$authenticatedUser) {
            return null;
        }
    
        // Check if the user's type is "activate"
        if ($authenticatedUser->status !== 'activate') {
            // If the user's type is not "activate", return null or handle the unauthorized access as needed
            return null;
        }
    
        // Fetch user information based on the authenticated user's username
        return User::where('username', $authenticatedUser->username)->first();
    }
    

    public function index() 
    {
         $user = $this->getUserInfo();

        // Check if the user is found
        if (!$user) {
            return redirect()->route('welcome')->withErrors(['error' => 'User not found.']);
        }

        // Check if the user type is 'student'
        if ($user->userType !== 'student') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        } 

        // Pass the information to the view
        return view('student.dashboard', ['user' => $user] );
    }

    public function quiz() 
    {
         $user = $this->getUserInfo();

        // Check if the user is found
        if (!$user) {
            return redirect()->route('welcome')->withErrors(['error' => 'User not found.']);
        }

        // Check if the user type is 'student'
        if ($user->userType !== 'student') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        }

        $quiz = QuizTitle::with('user', 'questions')->get();

        // Pass the information to the view
        return view('student.quiz', ['user' => $user, 'quiz' => $quiz]);
    }

    public function exam(Request $request) 
    {
        $user = $this->getUserInfo();
    
        // Check if the user is found
        if (!$user) {
            return redirect()->route('welcome')->withErrors(['error' => 'User not found.']);
        }
    
        // Check if the user type is 'student'
        if ($user->userType !== 'student') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        }

        // Get the quiz ID from the request
        $quizId = $request->query('quiz_id');

        // Fetch questions based on the quiz ID
        $questions = Question::where('quiztitle_id', $quizId)->get();
    
        // Pass the information to the view
        return view('student.exam', ['user' => $user, 'questions' => $questions]);
    }

    public function checkAnswer(Request $request) 
    {
        $questions = Question::all(); // Adjust based on your model and how you fetch questions
        $results = [];
    
        foreach ($questions as $question) {
            $questionId = $question->id;
            $userAnswer = $request->input("question_$questionId");
    
            if ($userAnswer == $question->answer) {
                $results[$questionId] = 'correct';
                $message = 'You are Correct!';
                $status = 'success';
            } else {
                $results[$questionId] = 'wrong';
                $message = 'You are Wrong!';
                $status = 'error';
            }
    
            // Fetch the next question based on the current question ID
            $nextQuestion = Question::where('id', '>', $questionId)->orderBy('id')->first();
    
            if ($nextQuestion) {
                // Redirect to the next question
                return redirect()->route('student.exam', ['quiz_id' => $nextQuestion->id])->with($status, $message);
            } else {
                // No more questions, redirect to the quiz summary or end
                return redirect()->route('student.quiz')->with($status, $message);
            }
        }
    }
}
