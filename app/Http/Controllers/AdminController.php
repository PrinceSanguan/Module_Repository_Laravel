<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\QuizTitle;
use App\Models\Question;
use App\Models\Module;
use App\Models\ModuleContent;

class AdminController extends Controller
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

        // Check if the user type is 'admin'
        if ($user->userType !== 'admin') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        }

        // Get the total number of Students
        $totalNumberOfStudent = User::where('userType', 'student')
        ->where('status', 'activate')
        ->count();

        // Get the total number of Teachers
        $totalNumberOfTeacher = User::where('userType', 'teacher')
        ->where('status', 'activate')
        ->count();

        // Get the total number of Quizzes
        $totalNumberOfQuiz = QuizTitle::all()->count();

        // Get the total number of Pending Accounts
        $totalNumberOfPendingAccounts = User::where('status', 'deactivate')
        ->count();

        // Pass the information to the view
        return view('admin.dashboard', compact('user', 'totalNumberOfStudent', 'totalNumberOfTeacher', 'totalNumberOfPendingAccounts', 'totalNumberOfQuiz'));
    }

    public function student() 
    {
        $user = $this->getUserInfo();

        // Check if the user is found
        if (!$user) {
            return redirect()->route('welcome')->withErrors(['error' => 'User not found.']);
        }

        // Check if the user type is 'admin'
        if ($user->userType !== 'admin') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        }

        // Fetch all accounts where userType is 'student' and status is 'activate'
        $data = User::where('userType', 'student')->where('status', 'activate')->get();

        // Pass the information to the view
        return view('admin.student', ['user' => $user, 'data' => $data]);
    }

    public function pending() 
    {
        $user = $this->getUserInfo();

        // Check if the user is found
        if (!$user) {
            return redirect()->route('welcome')->withErrors(['error' => 'User not found.']);
        }

        // Check if the user type is 'admin'
        if ($user->userType !== 'admin') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        }

        // Fetch all accounts where userType is 'student' and status is 'deactivate'
        $data = User::where('userType', 'student')->where('status', 'deactivate')->get();

        // Pass the information to the view
        return view('admin.pending', ['user' => $user, 'data' => $data]);
    }

    public function quiz()
    {
        // Your existing logic to retrieve user data and quizzes
        $user = $this->getUserInfo();
        // Check if the user is found
        if (!$user) {
            return redirect()->route('welcome')->withErrors(['error' => 'User not found.']);
        }
    
        // Check if the user type is 'admin'
        if ($user->userType !== 'admin') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        }
    
        // Retrieve quizzes published by Admin along with the count of questions
        $data = QuizTitle::all();

        // Loop through each quiz title to count its associated questions
        foreach ($data as $datas) {
            $datas->questions_count = Question::where('quiztitle_id', $datas->id)->count();
        }
    
        // Pass the information to the view along with $showQuestionModal
        return view('admin.quiz', ['user' => $user, 'data' => $data, 'questions' => null]);
    }

    public function viewQuestions(Request $request, $quizTitleId)
    {
        // Fetch questions based on the quiz title ID
        $questions = Question::where('quiztitle_id', $quizTitleId)->get();
        
        // Return the questions data as JSON
        return response()->json(['questions' => $questions]);
    }

    //////////////////////////// Deleting Quiz ///////////////////////////////////////
    public function deleteQuiz($quizTitleId)
    {
        // Find the quiz title by ID
        $quiz = QuizTitle::find($quizTitleId);
    
        // Check if the quiz title exists
        if (!$quiz) {
            // Return a response indicating failure (404 Not Found)
            return response()->json(['error' => 'Quiz not found.'], 404);
        }
    
        // Delete the quiz title
        $quiz->delete();
    
        // Return a response indicating success
        return response()->json(['message' => 'Quiz deleted successfully.']);
    }
    //////////////////////////// Deleting Quiz ///////////////////////////////////////

    public function module()
    {
        // Your existing logic to retrieve user data and quizzes
        $user = $this->getUserInfo();
        // Check if the user is found
        if (!$user) {
            return redirect()->route('welcome')->withErrors(['error' => 'User not found.']);
        }
    
        // Check if the user type is 'admin'
        if ($user->userType !== 'admin') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        }
    
        // fetch all module
        $modules = Module::all();
    
        // Pass the information to the view along with $showQuestionModal
        return view('admin.module', ['user' => $user, 'modules' => $modules]);
    }

    public function addModule(Request $request)
    {
        $user = $this->getUserInfo();

        // Create a new Quiz instance
        $module = new module();
        $module->user_id = $user->id;
        $module->title = $request->input('title');

        // Save the quiz to the database
        $module->save();

        // Display success message as alert
        echo "<script>alert('module is Added!'); window.location.href = '/admin/module';</script>";
    }

    public function addQuiz(Request $request)
    {
        $user = $this->getUserInfo();

        // Create a new Quiz instance
        $quiz = new QuizTitle();
        $quiz->user_id = $user->id;
        $quiz->title = $request->input('title');

        // Save the quiz to the database
        $quiz->save();

        // Display success message as alert
        echo "<script>alert('Quiz is Added!'); window.location.href = '/admin/quiz';</script>";
    }

    public function addQuestion(Request $request)
    {
        // Create a new Question instance
        $addQuestion = new Question();
        
        // Set the quiz title ID
        $addQuestion->quiztitle_id = $request->input('quiztitle_id');
    
        // Set the question and choices
        $addQuestion->question = $request->input('question');
        $addQuestion->choicesA = $request->input('choicesA');
        $addQuestion->choicesB = $request->input('choicesB');
        $addQuestion->choicesC = $request->input('choicesC');
        $addQuestion->choicesD = $request->input('choicesD');
        $addQuestion->choicesE = $request->input('choicesE');
    
        // Save the question to the database
        $addQuestion->save();
    
        // Display success message as alert
        echo "<script>alert('Question is Added!'); window.location.href = '/admin/quiz';</script>";
    }

    public function addImage(Request $request)
    {

        // Validate the request data with custom error messages
        $request->validate([
            'file' => 'required|image',
        ]);

        // Check if a file is uploaded
        if ($request->hasFile('file')) {
            // Store the file and get the path
            $path = $request->file('file')->store('/', ['disk' => 'my_disk']);
        } else {
            // Handle the case where no file is uploaded
            return redirect()->route('register')->with('error', 'Please upload an image.');
        }  

        // Saving in the database
        ModuleContent::create([
            'module_id' => $request->input('module_id'),
            'image' => $path,
        ]);

        // Display success message as alert
        echo "<script>alert('powerpoint is Added!'); window.location.href = '/admin/module';</script>";
        
        }
}
