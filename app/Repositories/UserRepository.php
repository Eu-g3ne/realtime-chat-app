<?php

namespace App\Repositories;

use App\Http\Requests\User\IndexRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
  public function all(): Collection
  {
    return User::all();
  }

  public function getByNickname(array $values): Collection
  {
    return User::whereNicknameLike($values['nickname'])->get()->except(auth()->id());
  }

  public function getById($id): User
  {
    return User::find($id);
  }
}
