<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    CharitableFoundationController,
    BranchController,
    DonationPostController,
    SupportProgramController,
    SupportProgramTypeController,
    UserController,
    CityController,
    DonationTypeController,
    PostTypeController,
    StatusTypeController,
    StateController,
    NewsController,
    SponsorShipController,
};

Route::group([
    "middleware" => []
], function () {


    #region ############ User ############ 
    Route::group([
        "prefix" => 'user'
    ], function () {
        Route::GET("indexDonors", [UserController::class, 'indexDonors']);
        Route::GET("indexSponsors", [UserController::class, 'indexSponsors']);
        Route::GET("{user}/show", [UserController::class, 'show']);  #*

    });
    #endregion

    #region ############ City ############ 
    Route::group([
        "prefix" => 'city'
    ], function () {
        Route::GET("index", [CityController::class, 'index']);
        Route::GET("{city}/show", [CityController::class, 'show']);

        Route::POST("store", [CityController::class, 'store']);
        Route::POST("{city}/update", [CityController::class, 'update']);
        Route::DELETE("{city}/destroy", [CityController::class, 'destroy']);
    });
    #endregion


    #region ############ CharitableFoundation ############  
    Route::group([
        "prefix" => 'charitablefoundation'
    ], function () {
        Route::GET("index", [CharitableFoundationController::class, 'index']);
        Route::GET("{charitablefoundation}/show", [CharitableFoundationController::class, 'show']);

        Route::POST("store", [CharitableFoundationController::class, 'store']);
        Route::POST("{charitablefoundation}/update", [CharitableFoundationController::class, 'update']);
        Route::DELETE("{charitablefoundation}/destroy", [CharitableFoundationController::class, 'destroy']);
    });

    #endregion


    #region ############ Branches ############ 
    Route::group([
        "prefix" => 'branch'
    ], function () {
        Route::GET("charitablefoundation/{charitablefoundation}/index", [BranchController::class, 'indexByCharitablefoundation']);
        Route::GET("{branch}/show", [BranchController::class, 'show']);

        Route::POST("store", [BranchController::class, 'store']);
        Route::POST("{branch}/update", [BranchController::class, 'update']);
        Route::DELETE("{branch}/destroy", [BranchController::class, 'destroy']);
    });
    #endregion


    #region ############ SupportProgramType ############ 
    Route::group([
        "prefix" => 'supportProgramType'
    ], function () {
        Route::GET("index", [SupportProgramTypeController::class, 'index']);
        Route::GET("{supportProgramType}/show", [SupportProgramTypeController::class, 'show']);

        Route::POST("store", [SupportProgramTypeController::class, 'store']);
        Route::POST("{supportProgramType}/update", [SupportProgramTypeController::class, 'update']);
        Route::DELETE("{supportProgramType}/destroy", [SupportProgramTypeController::class, 'destroy']);
    });
    #endregion


    #region ############ SupportProgram ############ 
    Route::group([
        "prefix" => 'supportProgram'
    ], function () {
        Route::GET("index", [SupportProgramController::class, 'index']);
        Route::GET("charitablefoundation/{charitablefoundation}/index", [SupportProgramController::class, 'indexByCharitablefoundation']);
        Route::GET("{supportProgram}/show", [SupportProgramController::class, 'show']);

        Route::POST("store", [SupportProgramController::class, 'store']);
        Route::POST("{supportProgram}/update", [SupportProgramController::class, 'update']);
        Route::DELETE("{supportProgram}/destroy", [SupportProgramController::class, 'destroy']);
    });
    #endregion

    
    #region ############ DonationPost ############ 
    Route::group([
        "prefix" => 'donationPost'
    ], function () {
        Route::GET("index", [DonationPostController::class, 'index']);
        Route::GET("charitablefoundation/{charitablefoundation}/index", [DonationPostController::class, 'indexByCharitablefoundation']);
        Route::GET("{donationPost}/show", [DonationPostController::class, 'show']);

        Route::POST("store", [DonationPostController::class, 'store']);
        Route::POST("storeCampaign", [DonationPostController::class, 'storeCampaign']);
        Route::POST("{donationPost}/update", [DonationPostController::class, 'update']);
        Route::DELETE("{donationPost}/destroy", [DonationPostController::class, 'destroy']);
    });
    #endregion


    #region ############ PostType ############ 
    Route::group([
        "prefix" => 'postType'
    ], function () {
        Route::GET("index", [PostTypeController::class, 'index']);
        Route::GET("{postType}/show", [PostTypeController::class, 'show']);

        Route::POST("store", [PostTypeController::class, 'store']);
        Route::POST("{postType}/update", [PostTypeController::class, 'update']);
        Route::DELETE("{postType}/destroy", [PostTypeController::class, 'destroy']);
    });
    #endregion


    #region ############ StatusType ############
    Route::group([
        "prefix" => 'statusType'
    ], function () {
        Route::GET("index", [StatusTypeController::class, 'index']);
        Route::GET("{statusType}/show", [StatusTypeController::class, 'show']);

        Route::POST("store", [StatusTypeController::class, 'store']);
        Route::POST("{statusType}/update", [StatusTypeController::class, 'update']);
        Route::DELETE("{statusType}/destroy", [StatusTypeController::class, 'destroy']);
    });
    #endregion


    #region ############ DonationType ############ 
    Route::group([
        "prefix" => 'donationType'
    ], function () {
        Route::GET("index", [DonationTypeController::class, 'index']);
        Route::GET("{donationType}/show", [DonationTypeController::class, 'show']);

        Route::POST("store", [DonationTypeController::class, 'store']);
        Route::POST("{donationType}/update", [DonationTypeController::class, 'update']);
        Route::DELETE("{donationType}/destroy", [DonationTypeController::class, 'destroy']);
    });
    #endregion


    #region ############ State ############ 
    Route::group([
        "prefix" => 'state'
    ], function () {
        Route::GET("indexDonation", [StateController::class, 'indexDonation']);
        Route::GET("indexSponsorShip", [StateController::class, 'indexSponsorShip']);
        Route::GET("{state}/show", [StateController::class, 'show']);

        // Route::POST("store", [StateController::class, 'store']);
        Route::POST("{state}/update", [StateController::class, 'update']);
        Route::POST("{state}/updateAmount", [StateController::class, 'updateAmount']);
        // Route::DELETE("{state}/destroy", [StateController::class, 'destroy']);
    });
    #endregion


    #region ############ News ############
    Route::group([
        "prefix" => 'news'
    ], function () {
        Route::GET("index", [NewsController::class, 'index']);
        Route::GET("charitablefoundation/{charitablefoundation}/index", [NewsController::class, 'indexByCharitablefoundation']);
        Route::GET("{news}/show", [NewsController::class, 'show']);

        Route::POST("store", [NewsController::class, 'store']);
        Route::POST("{news}/update", [NewsController::class, 'update']);
        Route::DELETE("{news}/destroy", [NewsController::class, 'destroy']);
    });
    #endregion


    #region ############ SponsorShip ############
    Route::group([
        "prefix" => 'sponsorShip'
    ], function () {
        Route::POST("/{sponsorShip}/updateDeliveryToDone", [SponsorShipController::class, 'updateDeliveryToDone']);
    });
    #endregion



    #region ############ Support ############ 
    Route::GET("charitablefoundation/{charitablefoundation}/supportProgram", [SupportProgramController::class, 'indexByCharitablefoundation']);
    Route::GET("branch/{branch}/supportProgram", [SupportProgramController::class, 'indexByBranch']);
    Route::GET("supportProgram/{supportProgram}", [SupportProgramController::class, 'show']);

    Route::POST("branch/{branch}/supportProgram", [SupportProgramController::class, 'store']);
    Route::POST("supportProgram/{supportProgram}", [SupportProgramController::class, 'update']);
    Route::DELETE("supportProgram/{supportProgram}", [SupportProgramController::class, 'destroy']);

    #endregion
});
