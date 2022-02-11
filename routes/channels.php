<?php

use \Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{id}', function ($user, $id) {
    return ((int) $user->id === (int) $id);
});

Broadcast::channel('tasks.{task}', function ($user, \App\Models\Task $task) {
    return $user->isCustomer() && ((int) $task->customer->id === (int) $user->id);
});

Broadcast::channel('campaigns.{campaign}', function ($user, \App\Models\Campaign $campaign) {
    return $user->isCustomer() && ((int) $campaign->customer->id === (int) $user->id);
});

Broadcast::channel('schedules.{schedule}', function ($user, \App\Models\Schedule $schedule) {
    return $user->isCustomer() && ((int) $schedule->customer->id === (int) $user->id);
});
