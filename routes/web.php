<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

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



Route::get('/', [ClientController::class, 'homePage']);
Route::get('sign-in', [ClientController::class, 'signInPage'])->name('sign.in');
Route::get('register', [ClientController::class, 'registerPage'])->name('sign.up');
Route::get('dashboard', [ClientController::class, 'dashboardPage'])->name('dashboard');
Route::get('featured', [ClientController::class, 'featuredgames'])->name('featured.games');
Route::get('profile', [ClientController::class, 'myProfile'])->name('profile');
Route::get('change-pwd', [ClientController::class, 'changePwd'])->name('change-password');
Route::get('update-user', [ClientController::class, 'updateUser'])->name('update_user');
Route::get('forgot-pwd', [ClientController::class, 'forgotPwd'])->name('forgot-pwd');
Route::get('/view-details/{match_id}', [ClientController::class, 'viewDetails'])->name('match.view-details');