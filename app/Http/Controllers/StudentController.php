<?php

namespace App\Http\Controllers;

use App\Models\QuizTitle;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentQuiz;
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

    public function exam() 
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
        return view('student.exam', ['user' => $user]);
    }
}
