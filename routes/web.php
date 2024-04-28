<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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


Route::get('/', [LoginController::class, 'welcome'])->name('welcome');
Route::post('/', [LoginController::class, 'login'])->name('login.post');

Route::middleware(['auth'])->group(function () {

    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    /******************************************** This Route is For Logout *****************************/
    Route::get('/logout', function (Request $request) {
        Session::flush();
        Auth::logout();
    
        return redirect()->route('welcome');
    })->name('logout');
    /******************************************** This Route is For Logout *****************************/

});
