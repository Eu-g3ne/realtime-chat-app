<?php

namespace App\Http\Middleware;

use App\Exceptions\ForbiddenException;
use App\Models\Message;
use Closure;
use Illuminate\Http\Request;

class EnsureUserIsMessageOwner
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
    $message = $request->route('message'); // explicit binded
    if ($message->user->id === auth()->id()) {
      return $next($request);
    }
    throw new ForbiddenException('You are not the owner of the message');
  }
}
