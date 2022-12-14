<?php

namespace App\Providers;

use App\Repositories\Interfaces\MessageRepositoryInterface;
use App\Repositories\Interfaces\ThreadRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\MessageRepository;
use App\Repositories\ThreadRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    $this->app->bind(ThreadRepositoryInterface::class, ThreadRepository::class);
    $this->app->bind(MessageRepositoryInterface::class, MessageRepository::class);
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
