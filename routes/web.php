<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserManagementController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// -----------------------------login-----------------------------------------
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ------------------------------register---------------------------------------
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register');

// -----------------------------forget password ------------------------------
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// -----------------------------reset password ------------------------------
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);

// // -----------------------------form-----------------------------------------
Route::get('form/new', [App\Http\Controllers\FormController::class, 'index'])->name('form/new');
Route::post('form/save', [App\Http\Controllers\FormController::class, 'save'])->name('form/save');
Route::get('form/view/report', [App\Http\Controllers\FormController::class, 'viewReport'])->name('form/view/report');
Route::get('form/view/update/{id}', [App\Http\Controllers\FormController::class, 'viewUpdate']);
Route::get('form/delete/{id}', [App\Http\Controllers\FormController::class, 'delete']);

// -----------------------------user management-----------------------------------------
Route::get('role/user/view', [App\Http\Controllers\UserManagementController::class, 'index'])->name('role/user/view');
Route::post('role/user/save', [App\Http\Controllers\UserManagementController::class, 'save'])->name('role/user/save');
Route::post('role/user/update', [App\Http\Controllers\UserManagementController::class, 'update'])->name('role/user/update');
Route::get('role/user/view/report', [App\Http\Controllers\UserManagementController::class, 'viewReport'])->name('role/user/view/report');
Route::get('role/delete/{id}', [App\Http\Controllers\UserManagementController::class, 'delete']);



