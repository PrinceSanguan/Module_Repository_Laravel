<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{

    public function index()
    {    
        return view('welcome');
    }

    public function login(Request $request)
    {
        // If not authenticated, proceed with login attempt
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        // Attempt to authenticate user
        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();
    
            // Check if the user account is activate
            if ($user->status == 'activate') {
                // Redirect user to respective dashboard based on user type
                switch ($user->userType) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                        break;
                    case 'teacher':
                        return redirect()->route('teacher.dashboard');
                        break;
                    case 'student':
                        return redirect()->route('student.dashboard');
                        break;
                }
            } else {
                // If account is not activated, redirect back with an error message
                return redirect()->route('welcome')->with(['error' => 'Wait Ms. Ina V. Nucup to activate your account.']);
            }
        } else {
            // Authentication failed, redirect back to login page with error message
            return redirect()->route('welcome')->with(['error' => 'Invalid username or password']);
        }
    }
     

}


