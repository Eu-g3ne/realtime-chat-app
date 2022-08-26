<?php

namespace App\Events\Abstracts;

use App\Models\Message;
use App\Models\Thread;

class AbstractMessageEvent
{
  protected $thread;
  protected $message;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct(Thread $thread, Message $message)
  {
    $this->thread = $thread;
    $this->message = $message;
  }
}
