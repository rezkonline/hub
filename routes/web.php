<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('lang/{lang}', 'HomeController@lang')->name('lang');

Route::get('email/verify', 'VerificationController@email')->middleware('auth')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'VerificationController@markEmailAsVerified')->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('email/verification-notification', 'VerificationController@resendEmail')->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('/{any?}', 'HomeController@index')->where('any', '^(?!dashboard|api|storage|broadcasting|lang)[\/\w\.-]*')->name('home')->middleware(['auth', 'verified']);
