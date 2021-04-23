<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\RequestBook;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::resource('cities',CityController::class);
Route::resource('places',PlaceController::class);
Route::resource('categories',CategoryController::class);
Route::resource('books',BookController::class);
Route::resource('feedback',FeedbackController::class);
Route::resource('requestdbook',RequestBook::class);