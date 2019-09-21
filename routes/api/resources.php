<?php

Route::group(['namespace' => 'Resources'], function () {
    Route::apiResources([
        'admin-models' => 'AdminModelController',
        'user-models' => 'UserModelController',
        'user-related-models' => 'UserRelatedModelController',
        'users' => 'UserController',
    ]);
});
