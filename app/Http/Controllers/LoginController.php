<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        // Check if the user is already authenticated
        if (auth()->check()) {
            // Check if user type is not null
            if (auth()->user()->userType !== null) {
                // User is already logged in and type is not null, redirect to the appropriate dashboard
                switch (auth()->user()->userType) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'teacher':
                        return redirect()->route('teacher.dashboard');
                    case 'student':
                        return redirect()->route('student.dashboard');
                    default:
                        // Redirect to login with error message if user type is unknown
                        return redirect()->route('auth.login')->with(['error' => 'Your account type is not determined. Please contact the CEO.']);
                }
            }
        }

        // User is not logged in, show the login form
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    
        // Attempt to authenticate user
        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();
    
            // Check user type and redirect accordingly
            switch ($user->userType) {
                case 'admin':
                    // Redirect to admin dashboard
                    return redirect()->route('admin.dashboard');
                    break;
                case 'teacher':
                    // Redirect to teacher dashboard
                    return redirect()->route('teacher.dashboard');
                    break;
                case 'student':
                    // Redirect to student dashboard
                    return redirect()->route('student.dashboard');
                    break;
            }
        } else {
            // Authentication failed, redirect back to login page with error message
            return redirect()->route('welcome')->with(['error' => 'Invalid username or password']);
        }
    }

    public function welcome() {
        return view('welcome');
    }
}


