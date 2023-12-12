<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function() {
    return Inertia::render("index");
})->name("index");

Route::prefix("users")->group(function() {
    Route::get("/", [UserController::class, "list"])->name("users.list");
});

Route::group([
    "middleware" => "auth.guard"
], function() {
    Route::get("/login", [UserController::class, "login"])->name("login");

    Route::prefix("register")->group(function() {
        Route::get("/", function() {
            return Inertia::render("register");
        });
        Route::get("/token/{token}", [UserController::class, "verifyEmail"])->name("register.token");
    });
});