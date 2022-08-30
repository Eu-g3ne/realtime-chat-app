<?php

namespace App\Repositories;

use App\Models\Thread;
use App\Repositories\Interfaces\ThreadRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class ThreadRepository implements ThreadRepositoryInterface
{
  public function all(): Collection
  {
    return Thread::forAuthenticatedUser()->withLastMessage()->with('users')->get();
  }

  public function getByName(array $values): Collection
  {
    return Thread::whereName('like', $values['name'] . '%')->get();
  }

  public function getById($id): Thread
  {
    return Thread::find($id);
  }

  public function save(array $values): Thread
  {
    $thread = auth()->user()->threads()->create(['name' => $values['name']]);
    $thread->users()->attach($values['users']);
    return $thread->load('users');
  }

  public function update(Thread $thread, array $values): Thread
  {
    $thread->update(['name' => $values['name']]);
    $thread->users()->sync([...$values['users'], auth()->id()]);
    return $thread;
  }

  public function leave(Thread $thread): Thread
  {
    $thread->users()->detach(auth()->id());
    if (!$thread->users()->exists()) {
      $thread->delete();
    }
    return $thread;
  }
}
