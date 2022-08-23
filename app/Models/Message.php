<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
  use HasFactory;

  protected $fillable = [
    'body',
    'thread_id'
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

  protected function getCreatedAtAttribute($value)
  {
    return Carbon::createFromDate($value)->format('Y-m-d H:i:s');
  }

  protected function getUpdatedAtAttribute($value)
  {
    return Carbon::createFromDate($value)->format('Y-m-d H:i:s');
  }
}
