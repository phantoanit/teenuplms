<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('parents', App\Http\Controllers\ParentController::class);
Route::resource('students', App\Http\Controllers\StudentsController::class);
Route::resource('classes', App\Http\Controllers\ClassesController::class);
Route::post('classes/{class_id}/register', [App\Http\Controllers\ClassRegistrationsController::class, 'register']);
Route::resource('subscriptions', App\Http\Controllers\SubscriptionsController::class);
Route::patch('subscriptions/{id}/use', [App\Http\Controllers\SubscriptionsController::class, 'update']);