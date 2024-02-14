<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FootballController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('fixtures')->group(function () {
    Route::post('/get', [FootballController::class, 'fetchAndSave']);
    Route::get('matches', [FootballController::class, 'fetchSavedFeatures']);
});


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'registerUser']);
    Route::delete('delete/{user_id}', [AuthController::class, 'deleteUser']);
    Route::put('/update/{id}', [AuthController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/login', [AuthController::class, 'loginUser']);
    Route::get('/fetch-user/{user_id?}', [AuthController::class, 'getUsers']);
    Route::delete('/delete-user/{user_id}', [AuthController::class, 'getUsers']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::get('feature/{match_id}', [FootballController::class, 'fetchSingleMatch']);

});