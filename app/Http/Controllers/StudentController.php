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
    
        // Get the current question number from the request
        $questionNumber = $request->query('question_number', 1);
    
        // Fetch the question based on the quiz ID and question number
        $question = Question::where('quiztitle_id', $quizId)
                           ->orderBy('id', 'asc')
                           ->skip($questionNumber - 1)
                           ->first();
    
        // Count total number of questions for this quiz
        $totalQuestions = Question::where('quiztitle_id', $quizId)->count();
    
        // Pass the information to the view
        return view('student.exam', ['user' => $user, 'question' => $question, 'questionNumber' => $questionNumber, 'totalQuestions' => $totalQuestions]);
    }
    

    public function checkAnswer(Request $request) 
    {
        // Retrieve the quiz ID and current question number from the request
        $quizId = $request->input('quiz_id');
        $questionNumber = $request->input('question_number');
    
        // Retrieve the question based on the quiz ID and question number
        $question = Question::where('quiztitle_id', $quizId)
                            ->where('id', $questionNumber)
                            ->first();
    
        // Check if the question exists
        if (!$question) {
            // Handle error if question does not exist
            return redirect()->route('student.quiz')->withErrors(['error' => 'Question not found.']);
        }
    
        // Retrieve the user's answer for this question
        $userAnswer = $request->input("question_$questionNumber");
    
        // Check if the user's answer is correct
        if ($userAnswer == $question->answer) {
            $message = 'You are Correct!';
            $status = 'success';
        } else {
            $message = 'You are Wrong!';
            $status = 'error';
        }
    
        // Fetch the next question based on the current question number
        $nextQuestion = Question::where('quiztitle_id', $quizId)
                                ->where('id', '>', $questionNumber)
                                ->orderBy('id')
                                ->first();
    
        if ($nextQuestion) {
            // Redirect to the next question
            return redirect()->route('student.exam', ['quiz_id' => $quizId, 'question_number' => $nextQuestion->id])->with($status, $message);
        } else {
            // No more questions, redirect to the quiz summary or end
            return redirect()->route('student.quiz')->with($status, $message);
        }
    }
}
