<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\QuizTitle;
use App\Models\Question;
use App\Models\Module;
use App\Models\ModuleContent;

class TeacherController extends Controller
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

        // Check if the user type is 'teacher'
        if ($user->userType !== 'teacher') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        } 

        // Pass the information to the view
        return view('teacher.dashboard', [
        'user' => $user
        ]);
    }

    public function student() 
    {
        $user = $this->getUserInfo();

        // Check if the user is found
        if (!$user) {
            return redirect()->route('welcome')->withErrors(['error' => 'User not found.']);
        }

        // Check if the user type is 'teacher'
        if ($user->userType !== 'teacher') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        }

        // Fetch the student that handled by teacher
        $data = User::where('userType', 'student')
                    ->where('status', 'activate')
                    ->where('section', $user->section)
                    ->where('school', $user->school)->get();

        // Pass the information to the view
        return view('teacher.student', ['user' => $user, 'data' => $data]);
    }

    public function quiz()
    {
        // Your existing logic to retrieve user data and quizzes
        $user = $this->getUserInfo();
        // Check if the user is found
        if (!$user) {
            return redirect()->route('welcome')->withErrors(['error' => 'User not found.']);
        }
    
        // Check if the user type is 'teacher'
        if ($user->userType !== 'teacher') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        }

        // Retrieve quizzes published by Teacher along with the count of questions
        $data = QuizTitle::all();

        // Loop through each quiz title to count its associated questions
        foreach ($data as $datas) {
            $datas->questions_count = Question::where('quiztitle_id', $datas->id)->count();
        }
    
        // Pass the information to the view along with $showQuestionModal
        return view('teacher.quiz', ['user' => $user, 'data' => $data]);
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
        echo "<script>alert('Quiz is Added!'); window.location.href = '/teacher/quiz';</script>";
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
    
            // Determine the answer based on the user's choice
        switch ($request->input('answer')) {
            case 'A':
                $addQuestion->answer = $request->input('choicesA');
                break;
            case 'B':
                $addQuestion->answer = $request->input('choicesB');
                break;
            case 'C':
                $addQuestion->answer = $request->input('choicesC');
                break;
            case 'D':
                $addQuestion->answer = $request->input('choicesD');
                break;
            default:
                // Handle the case where no answer is provided
                // You might want to add validation to ensure that an answer is always selected
                break;
        }

        // Save the question to the database
        $addQuestion->save();

        // Display success message as alert
        echo "<script>alert('Question is Added!'); window.location.href = '/teacher/quiz';</script>";
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
    
        // Check if the user type is 'teacher'
        if ($user->userType !== 'teacher') {
            // Redirect to the same page with an error message
            return redirect()->route('welcome')->withErrors(['error' => 'Access denied.']);
        }
    
        // fetch all module
        $modules = Module::all();

        foreach ($modules as $module) {
            $module->modulecontent_count = ModuleContent::where('module_id', $module->id)->count();
        }
    
        // Pass the information to the view along with $showQuestionModal
        return view('teacher.module', ['user' => $user, 'modules' => $modules]);
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
        echo "<script>alert('module is Added!'); window.location.href = '/teacher/module';</script>";
    }

    public function addImage(Request $request)
    {
        // Validate the request data with custom error messages
        $request->validate([
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:2048', // Adjust the maximum file size as needed
        ], [
            'files.*.required' => 'All files are required.',
            'files.*.file' => 'The uploaded file is not valid.',
            'files.*.mimes' => 'All files must be either an image (jpeg, png, jpg, gif) or a PDF.',
            'files.*.max' => 'Each file may not be greater than :max kilobytes.',
        ]);

        // Check if files are uploaded
        if ($request->hasFile('files')) {
            // Iterate over each file
            foreach ($request->file('files') as $file) {
                // Store the file and get the path
                $path = $file->store('/', ['disk' => 'my_disk']);

                // Saving in the database
                ModuleContent::create([
                    'module_id' => $request->input('module_id'),
                    'image' => $path,
                ]);
            }

            // Display success message as alert
            echo "<script>alert('Module Content is Added!'); window.location.href = '/teacher/module';</script>";
        } else {
            // Handle the case where no file is uploaded
            return redirect()->route('register')->with('error', 'Please upload at least one file.');
        }
    }

    public function viewModules(Request $request, $moduleId)
    {
        // Fetch module content based on the module id
        $modules = ModuleContent::where('module_id', $moduleId)->get();

        // Return the modules data as JSON
        return response()->json(['modules' => $modules]);
    }

    //////////////////////////// Deleting Module ///////////////////////////////////////
public function deleteModule($moduleId)
{
    // Find the module by ID
    $module = Module::find($moduleId);

    // Check if the module exists
    if (!$module) {
        // Return a response indicating failure (404 Not Found)
        return response()->json(['error' => 'Module not found.'], 404);
    }

    // Retrieve all ModuleContent records associated with the Module
    $moduleContents = ModuleContent::where('module_id', $moduleId)->get();

    // Loop through the ModuleContent records
    foreach ($moduleContents as $moduleContent) {
        // Delete the associated image
        $imagePath = public_path('upload-image/') . $moduleContent->image;
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image file
        }

        // Delete the ModuleContent record
        $moduleContent->delete();
    }

    // Delete the module
    $module->delete();

    // Return a response indicating success
    return response()->json(['message' => 'Module and associated images deleted successfully.']);
}
//////////////////////////// Deleting Module ///////////////////////////////////////

}
