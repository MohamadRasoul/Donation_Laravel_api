<?php

use Illuminate\Support\Facades\Route;


Route::group([
    "middleware" => ['auth:api']
], function () {

    Route::group([
        "middleware" => ['role:User']
    ], function () {
        
    });
});
