<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\User\IndexRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
  public function all(): Collection;

  public function getByNickname(array $values);

  public function getById($id): User;
}
