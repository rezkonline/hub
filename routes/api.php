<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('countries/select', 'SelectController@countries')->name('countries.select');
    Route::get('cities/select', 'SelectController@cities')->name('cities.select');
    Route::get('supervisors/select', 'SelectController@supervisors')->name('supervisors.select');
    Route::get('employees/select', 'SelectController@employees')->name('employees.select');
    Route::get('packages/select', 'SelectController@packages')->name('packages.select');

    $routes = [
        'tasks',
        'schedules',
        'campaigns',
    ];

    foreach ($routes as $route) {
        Route::prefix($route . '/{'. Str::singular($route) .'}')->name($route . '.')->group(function () use ($route) {
            Route::get('attachments', Str::ucfirst(Str::singular($route)) . 'Controller@attachments')->name('attachments');
            Route::get('comments', Str::ucfirst(Str::singular($route)) . 'Controller@comments')->name('comments');
            Route::post('comment', Str::ucfirst(Str::singular($route)) . 'Controller@comment')->name('comment');
            Route::get('logs', Str::ucfirst(Str::singular($route)) . 'Controller@logs')->name('logs');
        });
        Route::apiResource($route, Str::ucfirst(Str::singular($route)) . 'Controller');
    }

    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('chat', 'MessageController@chat')->name('chat');
        Route::get('last', 'MessageController@last')->name('last');
    });
    Route::apiResource('messages', 'MessageController')->only(['index', 'store', 'update']);

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', 'UserController@index')->name('index');
        Route::get('manager', 'UserController@manager')->name('manager');
        Route::get('achievements', 'UserController@achievements')->name('achievements');
        Route::get('transactions', 'UserController@transactions')->name('transactions');
        Route::get('packages', 'UserController@packages')->name('packages');
        Route::post('notification', 'UserController@markNotificationAsRead')->name('markNotificationAsRead');
        Route::post('notifications/read', 'UserController@markNotificationsAsRead')->name('markNotificationAsRead');
        Route::get('impersonate/leave', 'UserController@leaveImpersonating');

        Route::post('update', 'UserController@update')->name('update');
    });

    Route::get('notifications/count', 'NotificationController@count')->name('notifications.count');
    Route::get('notifications', 'NotificationController@index')->name('notifications.index');
});

Route::post('cities', 'CityController@index')->name('cities.index');
Route::resource('settings', 'SettingController')->only(['index']);
