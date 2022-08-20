<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'nickname',
    'password',
  ];


  public $timestamps = false;
  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  public function messages(): HasMany
  {
    return $this->hasMany(Message::class);
  }

  public function threads(): BelongsToMany
  {
    return $this->belongsToMany(Thread::class, 'participants', 'user_id', 'thread_id');
  }

  protected function setPasswordAttribute($value)
  {
    $this->attributes['password'] = bcrypt($value);
  }

  public function scopeLoadThread($query, $thread)
  {
    return $query->load(['messages' => function ($q) use ($thread) {
      $q->where('thread_id', $thread->id);
    }]);
  }

  public function scopeWhereNicknameLike($query, $nickname)
  {
    return $query->where('nickname', 'like', $nickname . '%');
  }
}
