<?php

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
    return view("pages.index");
})->name("index");

Route::get("/login", function() {
    return view("pages.login");
})->name("login");

Route::prefix("register")->group(function() {
    Route::get("/", function() {
        return "TODO";
    });
    Route::get("/token/{token}", [UserController::class, "verifyEmail"])->name("register.token");
});