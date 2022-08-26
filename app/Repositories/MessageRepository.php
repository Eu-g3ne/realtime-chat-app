<?php

namespace App\Repositories;

use App\Models\Message;
use App\Models\Thread;
use App\Repositories\Interfaces\MessageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository implements MessageRepositoryInterface
{
  public function getByThread(Thread $thread): Collection
  {
    return Message::with('user')->whereThread($thread)->oldest()->get();
  }

  public function getById($id): Message
  {
    return Message::findOrFail($id);
  }

  public function save(Thread $thread, array $values): Message
  {
    $message = auth()->user()->messages()->create([...$values, 'thread_id' => $thread->id]);
    $thread->lastMessage()->associate($message->id)->save();
    return $message;
  }

  public function update(Thread $thread, Message $message, array $values): Message
  {
    $message->update($values);
    return $message;
  }

  public function delete(Message $message): Message
  {
    $message->delete();
    return $message;
  }
}
