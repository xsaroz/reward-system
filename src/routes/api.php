<?php

Route::group(['prefix' => '/api/v1', 'namespace' => '\Kunyo\RewardSystem\Controllers'], function () {
    // Orders routes
    Route::post('orders', 'OrderController@store');
    Route::get('orders', 'OrderController@list');
    Route::post('orders/update-status', 'OrderController@update_status');

    // Customer Routes
    Route::post('customers', 'CustomerController@store');
});

