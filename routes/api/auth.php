<?php

Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');
});
