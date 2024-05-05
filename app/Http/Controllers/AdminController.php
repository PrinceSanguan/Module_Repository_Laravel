<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        // Get the total number of Pending Accounts
        $totalNumberOfPendingAccounts = User::where('status', 'deactivate')
        ->count();

        // Pass the information to the view
        return view('admin.dashboard', compact('user', 'totalNumberOfStudent', 'totalNumberOfTeacher', 'totalNumberOfPendingAccounts'));
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
}
