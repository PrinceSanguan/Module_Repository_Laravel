<?php

namespace App\Http\Controllers;

use App\Models\QuizTitle;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentResult;
use App\Models\Module;
use App\Models\ModuleContent;

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

        // Count the number of entries in the QuizTitle model
        $quizTitleCount = QuizTitle::count();

        // Count the number of Module
        $moduleCount = Module::count();

        // Count the number of StudentResult entries associated with the user where availability is taken
        $studentResultCount = StudentResult::where('user_id', $user->id)
        ->where('availability', 'taken')
        ->count();

        // Pass the information to the view
        return view('student.dashboard', [
        'user' => $user,
        'quizTitleCount' => $quizTitleCount,
        'studentResultCount' => $studentResultCount,
        'moduleCount' => $moduleCount
        ]);

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
    
        // Retrieve the quizzes with their associated users and questions
        $quiz = QuizTitle::with('user', 'questions')->get();
    
        // Retrieve the student's exam results
        $studentResults = StudentResult::where('user_id', $user->id)->get();
    
        // Pass the information to the view
        return view('student.quiz', [
            'user' => $user,
            'quiz' => $quiz,
            'studentResults' => $studentResults
        ]);
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
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        }
    
        // Get the quiz ID from the request
        $quizId = $request->query('quiz_id');
        if (!$quizId) {
            return redirect()->route('student.quiz')->withErrors(['error' => 'Quiz ID is required.']);
        }
    
        // Check if there are any available questions for the quiz
        $totalQuestions = Question::where('quiztitle_id', $quizId)->count();
        if ($totalQuestions == 0) {
            return redirect()->route('student.quiz')->with(['error' => 'No questions available for this quiz.']);
        }
    
        // Check if the user has already started or completed this quiz
        $existingResult = StudentResult::where('user_id', $user->id)
                                       ->where('quiztitle_id', $quizId)
                                       ->first();
    
        if ($existingResult) {
            // If the quiz is already taken, redirect with an error message
            if ($existingResult->availability == 'taken') {
                return redirect()->route('student.quiz')->with(['error' => 'You have already taken this exam.']);
            }
        } else {
            // Create a Quiz and student relationship
            $studentResult = new StudentResult();
            $studentResult->user_id = $user->id;
            $studentResult->quiztitle_id = $quizId;
            $studentResult->score = 0;
            $studentResult->availability = 'available';
    
            // Save the quiz to the database
            $studentResult->save();
        }
    
        // Get the current question number from the request
        $questionNumber = $request->query('question_number', 1);
    
        // Fetch the question based on the quiz ID and question number
        $question = Question::where('quiztitle_id', $quizId)
                           ->orderBy('id', 'asc')
                           ->skip($questionNumber - 1)
                           ->first();
    
        // Pass the information to the view
        return view('student.exam', [
            'user' => $user, 
            'question' => $question, 
            'questionNumber' => $questionNumber, 
            'totalQuestions' => $totalQuestions
        ]);
    }
    

    public function checkAnswer(Request $request)
    {
        // Retrieve the user information
        $user = auth()->user();
    
        // Retrieve the quiz ID and current question number from the request
        $quizId = $request->input('quiz_id');
        $questionNumber = $request->input('question_number');
    
        // Retrieve the question based on the quiz ID and question number
        $question = Question::find($request->input('question_id'));
    
        // Check if the question exists
        if (!$question) {
            // Handle error if question does not exist
            return redirect()->route('student.quiz')->withErrors(['error' => 'Question not found.']);
        }
    
        // Retrieve the user's answer for this question
        $userAnswer = $request->input('answer');
    
        // Retrieve the correct answer for this question
        $correctAnswer = $request->input('correct_answer');
    
        // Retrieve or create the StudentResult
        $studentResult = StudentResult::firstOrNew([
            'user_id' => $user->id,
            'quiztitle_id' => $quizId
        ]);
    
        // Initialize score if it's a new record
        if (!$studentResult->exists) {
            $studentResult->score = 0;
        }
    
        // Check if the user's answer is correct and update the score
        if ($userAnswer == $correctAnswer) {
            $studentResult->score += 1;
        }
    
        // Save the updated score
        $studentResult->save();
    
        // Fetch the next question based on the current question number
        $nextQuestion = Question::where('quiztitle_id', $quizId)
                                ->orderBy('id', 'asc')
                                ->skip($questionNumber)
                                ->first();
    
        if ($nextQuestion) {
            // Redirect to the next question
            return redirect()->route('student.exam', ['quiz_id' => $quizId, 'question_number' => $questionNumber + 1]);
        } else {
            // No more questions, mark the quiz as taken and redirect to the quiz summary or end
            $studentResult->availability = 'taken';
            $studentResult->save();
            return redirect()->route('student.quiz')->with(['success' => 'You have finished the exam.']);
        }
    }
    

    public function module() 
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

        // fetch all module
        $modules = Module::all();

        foreach ($modules as $module) {
            $module->modulecontent_count = ModuleContent::where('module_id', $module->id)->count();
        }
    
        // Pass the information to the view
        return view('student.module', ['user' => $user, 'modules' => $modules]);
    }

}
