<?php

namespace App\Http\Middleware;

use App\Exceptions\ForbiddenException;
use App\Models\Thread;
use Closure;
use Illuminate\Http\Request;

class EnsureUserIsParticipantOfTheThread
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    $thread = $request->route('thread'); // explicit binded
    if ($thread->users->containsStrict('id', auth()->id())) {
      return $next($request);
    }
    throw new ForbiddenException('You are not a member of the thread ');
  }
}
