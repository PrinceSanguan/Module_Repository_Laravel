<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\TeacherController;
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
    Route::get('admin/student/{id}', [AdminController::class, 'viewResult'])->name('admin.viewResult');

    Route::get('admin/teacher', [AdminController::class, 'teacher'])->name('admin.teacher');

    Route::get('admin/pending', [AdminController::class, 'pending'])->name('admin.pending');
    Route::post('admin/pending/{id}/activate', [AdminController::class, 'pendingActivate'])->name('admin.pending_activate');
    Route::post('admin/pending/{id}/delete', [AdminController::class, 'pendingDelete'])->name('admin.pending_delete');

    Route::get('admin/module', [AdminController::class, 'module'])->name('admin.module');
    Route::post('admin/module', [AdminController::class, 'addModule'])->name('admin.addModule');
    Route::post('admin/module/add-image', [AdminController::class, 'addImage'])->name('admin.addImage');
    Route::get('admin/module/{moduleId}', [AdminController::class, 'viewModules'])->name('admin.viewModule');
    Route::get('admin/delete-module/{moduleId}', [AdminController::class, 'deleteModule']);

    Route::get('admin/quiz', [AdminController::class, 'quiz'])->name('admin.quiz');
    Route::get('admin/quiz/{quizTitleId}', [AdminController::class, 'viewQuestions'])->name('admin.viewQuestion');
    Route::post('admin/quiz', [AdminController::class, 'addQuiz'])->name('admin.addQuiz');
    Route::post('admin/quiz/add-question', [AdminController::class, 'addQuestion'])->name('admin.addQuestion');
    Route::get('admin/delete-quiz/{quizTitleId}', [AdminController::class, 'deleteQuiz']);

    Route::get('admin/change_username', [AdminController::class, 'changeUsername'])->name('admin.changeUsername');
    Route::post('admin/change_username', [AdminController::class, 'changeUsernameRequest'])->name('change.usernamerequest');

    Route::get('admin/change_password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('admin/change_password', [AdminController::class, 'changePasswordRequest'])->name('change.passwordrequest');


    /******************************************** This Route is For Admin *****************************/

    /******************************************** This Route is For Student *****************************/
    Route::get('student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');

    Route::get('student/exam', [StudentController::class, 'exam'])->name('student.exam');
    Route::post('student/exam', [StudentController::class, 'checkAnswer'])->name('student.check.answer');

    Route::get('student/quiz', [StudentController::class, 'quiz'])->name('student.quiz');

    Route::get('student/module', [StudentController::class, 'module'])->name('student.module');

    /******************************************** This Route is For Student *****************************/

    /******************************************** This Route is For Teacher *****************************/
    Route::get('teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');

    Route::get('teacher/student', [TeacherController::class, 'student'])->name('teacher.student');

    Route::get('teacher/quiz', [TeacherController::class, 'quiz'])->name('teacher.quiz');
    Route::post('teacher/quiz', [TeacherController::class, 'addQuiz'])->name('teacher.addQuiz');
    Route::post('teacher/quiz/add-question', [TeacherController::class, 'addQuestion'])->name('teacher.addQuestion');
    Route::get('teacher/quiz/{quizTitleId}', [TeacherController::class, 'viewQuestions'])->name('teacher.viewQuestion');
    Route::get('teacher/delete-quiz/{quizTitleId}', [TeacherController::class, 'deleteQuiz']);

    Route::get('teacher/module', [TeacherController::class, 'module'])->name('teacher.module');
    /* Route::post('teacher/module', [TeacherController::class, 'addModule'])->name('teacher.addModule'); */
    Route::post('teacher/module/add-image', [TeacherController::class, 'addImage'])->name('teacher.addImage');
    Route::get('teacher/module/{moduleId}', [TeacherController::class, 'viewModules'])->name('teacher.viewModule');
    /* Route::get('teacher/delete-module/{moduleId}', [TeacherController::class, 'deleteModule']); */
    /******************************************** This Route is For Teacher *****************************/

    /******************************************** This Route is For Logout *****************************/
    Route::get('/logout', function (Request $request) {
        Session::flush();
        Auth::logout();
    
        return redirect()->route('welcome');
    })->name('logout');
    /******************************************** This Route is For Logout *****************************/

});
