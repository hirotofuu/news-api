<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleLoginController;

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

Route::view('/', 'welcome');

Route::get('/auth/redirect', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/login/callback', [GoogleLoginController::class, 'authGoogleCallback']);
