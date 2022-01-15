<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// public Routes
Route::post('/register', [authController::class, 'register']);
Route::post('/login', [authController::class, 'login']);
    //*********************** */ Password Reset***************************
    Route::post('forgot-password', [authController::class, 'forgotPassword']);
    Route::post('reset-password', [authController::class, 'reset']);


Route::post('email/verification-notification', [authController::class, 'sendVerificationEmail'])->middleware('auth:sanctum')->name('verification.send');
Route::get('verify-email/{id}/{hash}', [authController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');

// Protected Routes
Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){
    Route::get('/user', [authController::class, 'show']);
    Route::get('/logout', [authController::class, 'logout']);
    Route::get('/user', [authController::class, 'show']);
    Route::get('/alluser', [authController::class, 'index']);
});
