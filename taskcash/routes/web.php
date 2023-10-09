<?php


Route::post('/logout', 'AuthController@logout');
Route::post('business/logout', 'AuthController@busLogout');

Route::get('/', 'AuthController@gotoLogin');
Route::get('/login', 'AuthController@loginPage')->name('login');
Route::post('/login', 'AuthController@login');
// Resgister
Route::get('/register', 'AuthController@registerPage');
Route::post('/register', 'AuthController@register');

Route::post('login', 'AuthController@login');

// Not Authorized Restaurants
Route::get('/notAuthorized', 'AuthController@notAuthorized');

// ForgotPass
Route::get('forgot-password', 'AuthController@forgotPass');
Route::post('recover-pass', 'AuthController@forgotPassword');
Route::get('/reset-pass/{email}/{token}', 'AuthController@resetPassword')->name('resetPassword');
Route::post('/reset-pass', 'AuthController@passwordResetting')->name('PasswordReset');

Route::group(['middleware'=> ['check_admin']], function(){

    Route::get('/dashboard', 'AdminController@dashboard');
    Route::resource('tasks', 'TaskController');

    Route::get('register-chart', 'AdminController@chart');
     // Profile / Chnage Password
    Route::get('profile', 'AuthController@profile');
    Route::post('update-profile', 'AuthController@updateProfile');
     Route::post('pass-change/{id}', 'AuthController@changePass')->name('users.change.pass');

    // Categories
    Route::resource('categories', 'CategoryController');

    // Activities
    Route::resource('activities', 'ActivityController');

    // Businesses
    Route::get('businesses', 'AdminController@businesses');
    Route::get('business/create', 'AdminController@createBusiness');
    Route::post('business/store', 'AdminController@storeBusiness');
    Route::get('business/{id}/edit', 'AdminController@editBusiness')->name('business.edit');
    Route::put('business/{id}/update', 'AdminController@updateBusiness')->name('business.update');
    Route::get('business/{id}/detail', 'AdminController@detailBusiness')->name('business.detail');
    Route::post('business/{id}/status', 'AdminController@activeBusiness')->name('business.status.change');

    // Users 
    Route::get('users', 'AdminController@users');
    Route::get('user/{id}/detail', 'AdminController@detailUser')->name('user.detail');

    // Tasks
    Route::get('approved-tasks', 'AdminController@approvedTasks');
    Route::get('unapproved-tasks', 'AdminController@unApprovedTasks');
    Route::get('completed-tasks', 'AdminController@completedTasks');
    Route::get('task/{id}/detail', 'AdminController@detailTask')->name('task.detail');
    Route::post('/task/{id}/approved', 'AdminController@approveTask')->name('task.approve');

     //Disputes
     Route::get('/unresolved-disputes', 'DisputeController@unResolvedDisputes');
     Route::get('/dispute/{id}/detail', 'DisputeController@detail');
     Route::post('/dispute/{id}/reply', 'DisputeController@reply');
     Route::get('/dispute/{id}/resolve', 'DisputeController@resolve');
    //  Route::get('/detail/{id}/dispute','DisputeController@replying');
     Route::post('/reply/{id}','DisputeController@reply');
     Route::get('/resolved-disputes', 'DisputeController@resolvedDisputes');
     
});

Route::group(['middleware'=> ['check_bus']], function(){
    Route::get('business-dashboard', 'BusinessController@dashboard');

    // Profile
    Route::get('business/profile', 'BusinessController@profile');
    Route::post('business/update-profile', 'BusinessController@updateProfile');
    Route::post('business/pass-change/{id}', 'BusinessController@changePass')->name('users.change.pass');

    // Tasks
    Route::post('tasks/validate', 'TaskController@validations');
    Route::resource('tasks', 'TaskController');

    // Transactions
    Route::get('transactions', 'BusinessController@transactions');

    // Disputes
    Route::get('disputes', 'DisputeController@disputes');
    Route::get('/task/{id}/dispute', 'DisputeController@create');
    Route::post('/dispute/store', 'DisputeController@store');
    Route::get('/dispute/{id}', 'DisputeController@business_dispute_detail');
    Route::post('/dispute/{id}/bus_reply', 'DisputeController@businessReply');
    Route::get('/dispute/{id}/bus_resolve', 'DisputeController@businessResolve');
});

// });