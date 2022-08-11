<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;


Route::group([
    "middleware" => []
], function () {


    #region ############ City ############
    Route::group([
        "prefix" => 'city'
    ], function () {
        Route::GET("index", [User\CityController::class, 'index']);
    });
    #endregion


    #region ############ CharitableFoundation ############
    Route::group([
        "prefix" => 'charitablefoundation'
    ], function () {
        Route::GET("index", [User\CharitablefoundationController::class, 'index']);
        Route::GET("{charitablefoundation}/show", [User\CharitableFoundationController::class, 'show']);
    });

    #endregion


    #region ############ Branches ############
    Route::group([
        "prefix" => 'branch'
    ], function () {
        Route::GET("charitablefoundation/{charitablefoundation}/index", [User\BranchController::class, 'indexByCharitablefoundation']);
    });
    #endregion




    #region ############ SupportProgram ############
    Route::group([
        "prefix" => 'supportProgram'
    ], function () {
        Route::GET("index", [User\SupportProgramController::class, 'index']);
        Route::GET("charitablefoundation/{charitablefoundation}/index", [User\SupportProgramController::class, 'indexByCharitablefoundation']);
    });
    #endregion


    #region ############ DonationPost ############
    Route::group([
        "prefix" => 'donationPost'
    ], function () {
        Route::GET("index", [User\DonationPostController::class, 'index']);
        Route::GET("charitablefoundation/{charitablefoundation}/index", [User\DonationPostController::class, 'indexByCharitablefoundation']);
    });
    #endregion


    #region ############ PostType ############
    Route::group([
        "prefix" => 'postType'
    ], function () {
        Route::GET("index", [User\PostTypeController::class, 'index']);
    });
    #endregion




    #region ############ News ############
    Route::group([
        "prefix" => 'news'
    ], function () {
        Route::GET("index", [User\NewsController::class, 'index']);
        Route::GET("charitablefoundation/{charitablefoundation}/index", [User\NewsController::class, 'indexByCharitablefoundation']);
    });
    #endregion

});
