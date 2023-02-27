<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SinglePageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CompaniesPageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactAdminController;
use App\Http\Controllers\CompanyUserController;
use App\Http\Controllers\OwnerController;

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

Route::get('/admin', function () {
    return view('admin.layout.master');
});

################## For Admin #############################
Route::name('admin.')->prefix('admin')->middleware('auth','user')->group(function () {
    Route::resource("", DashController::class);
    Route::resource("/booking", CompanyUserController::class);
	Route::resource("manage-companies", CompanyController::class);
	Route::resource("manage-contacts", ContactAdminController::class);
	Route::resource("manage-reviews", ReviewController::class);
	Route::resource("owners", OwnerController::class);
});
Route::name('admin.')->prefix('admin')->middleware('auth','user','owner')->group(function () {
Route::resource("manage-users", UserController::class);
});

Route::resource("/", LandingController::class);
Route::resource("/company", SinglePageController::class);
Route::resource("/review", ReviewController::class);
Route::resource("/user", UserProfileController::class);
Route::resource("/companies", CompaniesPageController::class);
Route::resource("/about", AboutController::class);
Route::resource("/contact", ContactController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
