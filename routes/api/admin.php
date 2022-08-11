<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::group([
    "middleware" => []
], function () {


    #region ############ User ############
    Route::group([
        "prefix" => 'user'
    ], function () {
        Route::GET("indexDonors", [Admin\UserController::class, 'indexDonors']);
        Route::GET("indexSponsors", [Admin\UserController::class, 'indexSponsors']);
        Route::GET("{user}/show", [Admin\UserController::class, 'show']);  #*

    });
    #endregion

    #region ############ Statistic ############
    Route::group([
        "prefix" => 'statistic'
    ], function () {
        Route::GET("showDonateStatistics", [Admin\CharitablefoundationController::class, 'showDonateStatistics']);
        Route::GET("showPostStatistics", [Admin\CharitablefoundationController::class, 'showPostStatistics']);
        Route::GET("showActivityStatistics", [Admin\CharitablefoundationController::class, 'showActivityStatistics']);
    });
    #endregion

    #region ############ City ############
    Route::group([
        "prefix" => 'city'
    ], function () {
        Route::GET("index", [Admin\CityController::class, 'index']);
        Route::GET("{city}/show", [Admin\CityController::class, 'show']);

        Route::POST("store", [Admin\CityController::class, 'store']);
        Route::POST("{city}/update", [Admin\CityController::class, 'update']);
        Route::DELETE("{city}/destroy", [Admin\CityController::class, 'destroy']);
    });
    #endregion


    #region ############ CharitableFoundation ############
    Route::group([
        "prefix" => 'charitablefoundation'
    ], function () {
        Route::GET("index", [Admin\CharitablefoundationController::class, 'index']);
        Route::GET("{charitablefoundation}/show", [Admin\CharitableFoundationController::class, 'show']);

        Route::POST("store", [Admin\CharitableFoundationController::class, 'store']);
        Route::POST("{charitablefoundation}/update", [Admin\CharitableFoundationController::class, 'update']);
        Route::DELETE("{charitablefoundation}/destroy", [Admin\CharitableFoundationController::class, 'destroy']);
    });

    #endregion


    #region ############ Branches ############
    Route::group([
        "prefix" => 'branch'
    ], function () {
        Route::GET("charitablefoundation/{charitablefoundation}/index", [Admin\BranchController::class, 'indexByCharitablefoundation']);
        Route::GET("{branch}/show", [Admin\BranchController::class, 'show']);

        Route::POST("store", [Admin\BranchController::class, 'store']);
        Route::POST("{branch}/update", [Admin\BranchController::class, 'update']);
        Route::POST("{branch}/addAmountDelivery", [Admin\BranchController::class, 'addAmountDelivery']);
        Route::DELETE("{branch}/destroy", [Admin\BranchController::class, 'destroy']);
    });
    #endregion


    #region ############ SupportProgramType ############
    Route::group([
        "prefix" => 'supportProgramType'
    ], function () {
        Route::GET("index", [Admin\SupportProgramTypeController::class, 'index']);
        Route::GET("{supportProgramType}/show", [Admin\SupportProgramTypeController::class, 'show']);

        Route::POST("store", [Admin\SupportProgramTypeController::class, 'store']);
        Route::POST("{supportProgramType}/update", [Admin\SupportProgramTypeController::class, 'update']);
        Route::DELETE("{supportProgramType}/destroy", [Admin\SupportProgramTypeController::class, 'destroy']);
    });
    #endregion


    #region ############ SupportProgram ############
    Route::group([
        "prefix" => 'supportProgram'
    ], function () {
        Route::GET("index", [Admin\SupportProgramController::class, 'index']);
        Route::GET("charitablefoundation/{charitablefoundation}/index", [Admin\SupportProgramController::class, 'indexByCharitablefoundation']);
        Route::GET("{supportProgram}/show", [Admin\SupportProgramController::class, 'show']);

        Route::POST("store", [Admin\SupportProgramController::class, 'store']);
        Route::POST("{supportProgram}/update", [Admin\SupportProgramController::class, 'update']);
        Route::DELETE("{supportProgram}/destroy", [Admin\SupportProgramController::class, 'destroy']);
    });
    #endregion


    #region ############ DonationPost ############
    Route::group([
        "prefix" => 'donationPost'
    ], function () {
        Route::GET("index", [Admin\DonationPostController::class, 'index']);
        Route::GET("campaign/index", [Admin\DonationPostController::class, 'indexCampaign']);
        Route::GET("charitablefoundation/{charitablefoundation}/index", [Admin\DonationPostController::class, 'indexByCharitablefoundation']);
        Route::GET("{donationPost}/show", [Admin\DonationPostController::class, 'show']);

        Route::POST("store", [Admin\DonationPostController::class, 'store']);
        Route::POST("storeCampaign", [Admin\DonationPostController::class, 'storeCampaign']);
        Route::POST("{donationPost}/update", [Admin\DonationPostController::class, 'update']);
        Route::DELETE("{donationPost}/destroy", [Admin\DonationPostController::class, 'destroy']);
    });
    #endregion


    #region ############ PostType ############
    Route::group([
        "prefix" => 'postType'
    ], function () {
        Route::GET("index", [Admin\PostTypeController::class, 'index']);
        Route::GET("{postType}/show", [Admin\PostTypeController::class, 'show']);

        Route::POST("store", [Admin\PostTypeController::class, 'store']);
        Route::POST("{postType}/update", [Admin\PostTypeController::class, 'update']);
        Route::DELETE("{postType}/destroy", [Admin\PostTypeController::class, 'destroy']);
    });
    #endregion


    #region ############ StatusType ############
    Route::group([
        "prefix" => 'statusType'
    ], function () {
        Route::GET("index", [Admin\StatusTypeController::class, 'index']);
        Route::GET("{statusType}/show", [Admin\StatusTypeController::class, 'show']);

        Route::POST("store", [Admin\StatusTypeController::class, 'store']);
        Route::POST("{statusType}/update", [Admin\StatusTypeController::class, 'update']);
        Route::DELETE("{statusType}/destroy", [Admin\StatusTypeController::class, 'destroy']);
    });
    #endregion




    #region ############ State ############
    Route::group([
        "prefix" => 'state'
    ], function () {
        Route::GET("indexDonationState", [Admin\StateController::class, 'indexDonationState']);
        Route::GET("indexSponsorShip", [Admin\StateController::class, 'indexSponsorShip']);
        Route::GET("{state}/show", [Admin\StateController::class, 'show']);

        // Route::POST("store", [Admin\StateController::class, 'store']);
        Route::POST("{state}/update", [Admin\StateController::class, 'update']);
        Route::POST("{state}/updateAmount", [Admin\StateController::class, 'updateAmount']);
        // Route::DELETE("{state}/destroy", [Admin\StateController::class, 'destroy']);
    });
    #endregion


    #region ############ News ############
    Route::group([
        "prefix" => 'news'
    ], function () {
        Route::GET("index", [Admin\NewsController::class, 'index']);
        Route::GET("charitablefoundation/{charitablefoundation}/index", [Admin\NewsController::class, 'indexByCharitablefoundation']);
        Route::GET("{news}/show", [Admin\NewsController::class, 'show']);

        Route::POST("store", [Admin\NewsController::class, 'store']);
        Route::POST("{news}/update", [Admin\NewsController::class, 'update']);
        Route::DELETE("{news}/destroy", [Admin\NewsController::class, 'destroy']);
    });
    #endregion


    #region ############ SponsorShip ############
    Route::group([
        "prefix" => 'sponsorShip'
    ], function () {
        Route::POST("/{sponsorShip}/updateDeliveryToDone", [Admin\SponsorShipController::class, 'updateDeliveryToDone']);
    });
    #endregion


});
