<?php


Route::get('/', 'AdminController@index');
Route::post('/login','AdminController@login');
Route::get('/forgot_password','AdminController@forgot_password');
Route::post('/forgot_password','AdminController@submit_forgot_password');




Route::group(['middleware'=> ['auth:admin']], function(){
    Route::post('/logout','AdminController@logout');
    Route::get('/dashboard','AdminController@dashboard');
    Route::get('/profile','AdminController@profile');
    Route::get('/edit_profile/{user_id}','AdminController@edit_profile');
    Route::post('/edit_profile','AdminController@submit_edit_profile');
    Route::get('/change_password','AdminController@change_password');
    Route::post('/change_password','AdminController@submit_change_password');
    Route::get('/add_property','AdminController@add_property');
    Route::post('/add_property','AdminController@submit_add_property');
    Route::get('/add_property_gallery/{property_id}','AdminController@add_property_gallery')->name('add_property_gallery');
    Route::post('/add_property_gallery','AdminController@submit_add_property_gallery')->name('submit_add_property_gallery');
    Route::get('/add_property_doc/{property_id}','AdminController@add_property_docs');
    Route::post('/add_property_doc','AdminController@submit_add_property_docs');
    Route::get('/edit_property/{property_id}','AdminController@edit_property')->name('edit_property');
    Route::post('/edit_property','AdminController@submit_edit_property');
    Route::get('/edit_property_gallery/{property_id}','AdminController@edit_property_gallery')->name('edit_property_gallery');
    Route::post('/edit_property_gallery','AdminController@submit_edit_property_gallery')->name('submit_edit_property_gallery');
    Route::get('/edit_property_doc/{property_id}','AdminController@edit_property_docs');
    Route::post('/edit_property_doc','AdminController@submit_edit_property_docs');
    Route::get('/delete_gallery/{property_id}','AdminController@delete_gallery');
    Route::get('/delete_doc/{property_id}','AdminController@delete_doc');
    Route::get('/property_detail/{property_id}','AdminController@property_detail');
    Route::get('/view_property','AdminController@view_property');
    Route::get('/add_vendor','AdminController@add_vendor');
    Route::post('/add_vendor','AdminController@submit_add_vendor');
    Route::get('/view_vendor','AdminController@view_vendor');
    Route::get('/vendor_detail/{vendor_id}','AdminController@vendor_detail');
    Route::get('/edit_vendor/{vendor_id}','AdminController@edit_vendor');
    Route::post('/edit_vendor','AdminController@submit_edit_vendor');
    Route::get('/services','AdminController@services');
    Route::post('/services','AdminController@submit_add_services');
    Route::post('/edit_service','AdminController@submit_edit_services');
    Route::get('/add_expense/{property_id}','AdminController@add_expense');
    Route::post('/add_expense','AdminController@submit_add_expense');
    Route::post('/add_expense_without_File','AdminController@submit_add_expense_without_File');
    Route::get('/expense_detail/{expense_id}','AdminController@expense_detail');
    Route::post('/add_expense_docs','AdminController@add_expense_docs');
    Route::get('/edit_expense/{expense_id}','AdminController@edit_expense');
    Route::post('/edit_expense','AdminController@submit_edit_expense');
    Route::get('/delete_expense_doc/{expense_id}','AdminController@delete_expense_doc');
    Route::get('/sell_property/{property_id}','AdminController@sell_property');
    Route::post('/sell_property','AdminController@submit_sell_property');
    Route::get('/view_fullpayment_properties','AdminController@view_fullpayment_properties');
    Route::get('/view_lease_properties','AdminController@view_lease_properties');
    Route::get('/sold_property_detail/{sold_property_id}','AdminController@sold_property_detail');
    Route::get('/accept_payment/{invoice_id}/{amount}/{sold_property_id}','AdminController@accept_payment');
    Route::get('/delete_service/{service_id}','AdminController@delete_service');
    Route::get('/delete_vendor/{vendor_id}','AdminController@delete_vendor');
    Route::get('/delete_property/{property_id}','AdminController@delete_property');
    Route::get('/delete_investor/{investor_id}','AdminController@delete_investor');
    Route::get('/delete_investment/{investment_id}','AdminController@delete_investment');
    Route::get('/cal_revenue','AdminController@cal_revenue');
    Route::get('/add_investor','AdminController@add_investor');
    Route::post('/add_investor','AdminController@submit_add_investor');
    Route::get('/edit_investor/{investor_id}','AdminController@edit_investor');
    Route::post('/edit_investor','AdminController@submit_edit_investor');
    Route::get('/view_investors','AdminController@view_investors');
    Route::get('/investor_detail/{investor_id}','AdminController@investor_detail');
});

// });