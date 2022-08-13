<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
  use HasFactory;

  protected $fillable = [
    'body'
  ];

  public function thread(): BelongsTo
  {
    return $this->belongsTo(Thread::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
  public function scopeWhereThread($q, Thread $thread)
  {
    return $q->where('thread_id', $thread->id);
  }
}
