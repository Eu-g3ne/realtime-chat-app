<?php

namespace App\Observers;

use App\Events\DeleteMessage;
use App\Events\SendMessage;
use App\Events\UpdateMessage;
use App\Models\Message;

class MessageObserver
{
  /**
   * Handle the Message "created" event.
   *
   * @param  \App\Models\Message  $message
   * @return void
   */
  public function created(Message $message)
  {
    broadcast(new SendMessage($message->thread, $message))->toOthers();
  }

  /**
   * Handle the Message "updated" event.
   *
   * @param  \App\Models\Message  $message
   * @return void
   */
  public function updated(Message $message)
  {
    broadcast(new UpdateMessage($message->thread, $message))->toOthers();
  }

  /**
   * Handle the Message "deleted" event.
   *
   * @param  \App\Models\Message  $message
   * @return void
   */
  public function deleted(Message $message)
  {
    broadcast(new DeleteMessage($message->thread, $message))->toOthers();
  }
}
