<?php

namespace App\Events;

use App\Events\Abstracts\AbstractMessageEvent;
use App\Http\Resources\MessageResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteMessage extends AbstractMessageEvent implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets;

  public function broadcastWith()
  {
    return (new MessageResource($this->message->load('user')))->resolve();
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\Channel|array
   */
  public function broadcastOn()
  {
    return new PrivateChannel("thread.{$this->thread->id}");
  }
}
