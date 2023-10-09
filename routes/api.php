<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');
Route::post('change-password', 'API\AuthController@changePassword');
Route::post('forgot-password', 'API\AuthController@forgotPassword');

Route::post('profile/edit', 'API\AuthController@profileUpdate');

// tasks
Route::post('tasks', 'API\TaskController@tasks');
Route::post('completed-tasks', 'API\TaskController@completedTasks');
Route::post('pending-tasks', 'API\TaskController@pendingTasks');
Route::post('pending-payment-tasks', 'API\TaskController@PendingPaymentTasks');
Route::post('complete-job', 'API\TaskController@completeJob');

// Transactions
Route::post('transactions', 'API\TaskController@transactions');

Route::post('/withdraw', 'API\TaskController@withDraw');