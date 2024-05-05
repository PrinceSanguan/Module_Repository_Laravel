<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignUpController extends Controller
{
    public function index() 
    {
        return view('signup');
    }

    public function signUpForm(Request $request)
    {
        // Validate the request data with custom error messages
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'password' => [
                'required',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).{6,}$/',
            ],
            'section' => 'required',
            'userType' => 'required',
        ], [
            'password.regex' => 'The password must contain at least one letter, one number, and be at least 6 characters long.',
        ]);
    
        // Saving in the database
        $user = User::create([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'section' => $request->input('section'),
            'userType' => $request->input('userType'),
        ]);
    
        if (!$user) {
            return redirect()->route('signup')->with('error', 'Failed to create user.');
        }
    
        // Redirect with success message
        return redirect()->route('welcome')->with('success', 'You have successfully signed in! Wait for the Approval of Ms. Ina V. Nucup.');
    }
}
