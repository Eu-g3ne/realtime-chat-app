<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Thread extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  public function messages(): HasMany
  {
    return $this->hasMany(Message::class);
  }

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'participants', 'thread_id', 'user_id');
  }

  public function lastMessage()
  {
    return $this->belongsTo(Message::class)->with('user');
  }

  public function scopeForAuthenticatedUser($query)
  {
    return $query->whereHas('users', function ($q) {
      $q->where('participants.user_id', auth()->user()->id);
    });
  }

  public function scopeWithLastMessage($query)
  {
    $query->addSelect([
      'last_message_id' => Message::select('id')
        ->whereColumn('thread_id', 'threads.id')
        ->latest()
        ->take(1)
    ])->with('lastMessage');
  }
}
