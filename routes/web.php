<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [LoginController::class, 'index'])->name('welcome');
Route::post('/', [LoginController::class, 'login'])->name('login.post');

Route::get('signup', [SignUpController::class, 'index'])->name('signup');
Route::post('signup', [SignUpController::class, 'signUpForm'])->name('signup.form');



Route::middleware(['auth'])->group(function () {

    /******************************************** This Route is For Admin *****************************/
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/student', [AdminController::class, 'student'])->name('admin.student');
    Route::get('admin/pending', [AdminController::class, 'pending'])->name('admin.pending');

    Route::get('admin/module', [AdminController::class, 'module'])->name('admin.module');

    Route::get('admin/quiz', [AdminController::class, 'quiz'])->name('admin.quiz');
    Route::get('admin/quiz/{quizTitleId}', [AdminController::class, 'viewQuestions'])->name('admin.viewQuestion');
    Route::post('admin/quiz', [AdminController::class, 'addQuiz'])->name('admin.addQuiz');
    Route::post('admin/quiz/add-question', [AdminController::class, 'addQuestion'])->name('admin.addQuestion');
    Route::get('admin/delete-quiz/{quizTitleId}', [AdminController::class, 'deleteQuiz']);
    /******************************************** This Route is For Admin *****************************/

    /******************************************** This Route is For Student *****************************/
    Route::get('student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    /******************************************** This Route is For Student *****************************/

    /******************************************** This Route is For Logout *****************************/
    Route::get('/logout', function (Request $request) {
        Session::flush();
        Auth::logout();
    
        return redirect()->route('welcome');
    })->name('logout');
    /******************************************** This Route is For Logout *****************************/

});
