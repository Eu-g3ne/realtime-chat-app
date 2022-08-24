<?php

use App\Models\Thread;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('thread.{threadId}', function ($user, $threadId) {
  return Thread::findOrFail($threadId)->users->pluck('id')->contains($user->id);
});

Broadcast::channel('channel', function ($user) {
  return true;
});
