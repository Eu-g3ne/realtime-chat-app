<?php

namespace App\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
  protected $code = 403;

  //
  /**
   * Report the exception.
   * 
   * @return void
   */
  public function report()
  {
    //
  }

  /**
   * Render the exception as an HTTP response.
   *
   * @param \Illuminate\Http\Request $request
   */
  public function render($request)
  {
    return response()->json([
      'message' => $this->getMessage()
    ], $this->code);
  }
}
