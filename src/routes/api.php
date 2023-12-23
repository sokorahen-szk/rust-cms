<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserPostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * /api/clans
 * /api/users
 * /api/tags
 * /api/posts
 */
Route::middleware(["api"])->resource("clans", ClanController::class);
Route::middleware(["api"])->resource("users", UserController::class);
Route::middleware(["api"])->resource("tags", TagController::class);
Route::middleware(["api"])->resource("posts", UserPostController::class);

Route::group([
    "middleware" => "api",
    "prefix" => "auth"
], function() {
    // GET /api/auth/logout
    Route::get("/logout", [AuthController::class, "logout"]);
    // POST /api/auth/login
    Route::post("/login", [AuthController::class, "login"]);
});
