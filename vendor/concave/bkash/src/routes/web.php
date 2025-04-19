<?php 
Route::get('bkash', function () {
    return view('bkash::index');
});

Route::group(['namespace' => 'Concave\Bkash\Controllers'], function(){
    Route::post('token', 'PaymentController@token')->name('token');
    Route::get('createpayment', 'PaymentController@createpayment')->name('createpayment');
    Route::get('executepayment', 'PaymentController@executepayment')->name('executepayment');
});

