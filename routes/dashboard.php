<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('locale/{locale}', 'LocaleController@update')->name('locale')->where('locale', '(ar|en)');

Route::prefix('users/{user}')->name('users.')->group(function () {
    Route::put('packages/attach', 'UserController@attachPackage')->name('attachPackage');
    Route::delete('packages/{package}/detach/', 'UserController@detachPackage')->name('detachPackage');
    Route::resource('messages', 'MessageController')->only(['index', 'create', 'store']);
    Route::resource('transactions', 'TransactionController')->only(['store', 'destroy']);
    Route::resource('attachments', 'AttachmentController')->only(['store', 'destroy']);
    Route::resource('achievements', 'AchievementController')->except(['index', 'show']);
    Route::post('activate', 'UserController@activate')->name('activate');
    Route::post('deactivate', 'UserController@deactivate')->name('deactivate');
});

Route::resources([
    'users' => 'UserController',
    'countries' => 'CountryController',
    'packages' => 'PackageController',
]);

Route::resource('cities', 'CityController')->except('index', 'create', 'store');

$routes = ['tasks', 'campaigns', 'schedules'];

Route::resource('tasks', 'TaskController')->only(['index', 'show', 'destroy']);
Route::resource('campaigns', 'CampaignController')->only(['index', 'show', 'destroy']);
Route::resource('schedules', 'TaskController')->only(['index', 'show', 'destroy']);

Route::resource('settings', 'SettingController')->only(['index', 'store']);

Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('financial', 'ReportController@financial')->name('financial');
    Route::get('arrears', 'ReportController@arrears')->name('arrears');
    Route::get('customers', 'ReportController@customers')->name('customers');
    Route::get('transactions', 'ReportController@transactions')->name('transactions');
});
