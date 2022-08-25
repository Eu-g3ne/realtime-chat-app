<?php

namespace App\Repositories\Interfaces;

use App\Models\Message;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Collection;

interface MessageRepositoryInterface
{
  public function getByThread(Thread $thread): Collection;

  public function getById($id): Message;

  public function save(Thread $thread, array $values): Message;

  public function delete(Message $message): Message;
}
