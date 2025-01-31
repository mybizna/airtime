<?php
// Replace 'AirtimeController' with your actual controller name
use Illuminate\Support\Facades\Route;

use Modules\Airtime\Http\Controllers\AirtimeController;

// Routes for Views
Route::group(['middleware' => ['auth']], function () {
    Route::get('/airtime', [AirtimeController::class, 'index']);
    Route::post('/airtime/manage_airtime_purchase', [AirtimeController::class, 'manageAirtimePurchase']);
    Route::get('/airtime/user_airtime_payment_update', [AirtimeController::class, 'userAirtimePaymentUpdate']);

});
