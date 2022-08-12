<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Participant;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $user = User::factory()->create();
    $user2 = User::factory()->create();
    $thread = Thread::factory()->hasAttached(collect([$user, $user2]))->create();
    Message::factory()->count(3)->for($user)->for($thread)->create();
    Message::factory()->count(3)->for($user2)->for($thread)->create();
  }
}
