<?php
// Replace 'AirtimeController' with your actual controller name

// Routes for Views
Route::group(['middleware' => ['auth']], function () {
    Route::get('/airtime', 'AirtimeController@index');
    Route::post('/airtime/manage_airtime_purchase', 'AirtimeController@manageAirtimePurchase');
    Route::get('/airtime/user_airtime_payment_update', 'AirtimeController@userAirtimePaymentUpdate');

});
