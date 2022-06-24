<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::post("register/0", [AuthController::class, "registerAdmin"]);
Route::post("register/1", [AuthController::class, "registerUser"]);
Route::post("login/{role}", [AuthController::class, "login"]);

Route::group([
    "middleware" => ["auth:api"]
], function () {
    Route::get("profile", [AuthController::class, "profile"]);
    Route::get("logout", [AuthController::class, "logout"]);
});
