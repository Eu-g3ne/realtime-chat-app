<?php

namespace App\Repositories\Interfaces;

use App\Models\Thread;
use Illuminate\Database\Eloquent\Collection;

interface ThreadRepositoryInterface
{
  public function all(): Collection;

  public function getByName(array $values);

  public function getById($id): Thread;

  public function save(array $values): Thread;
}
