<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Exceptions\GeneralJsonException;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Http\Resources\UserCollection;
use App\Models\Message;
use App\Models\Thread;
use App\Repositories\Interfaces\MessageRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class MessageController extends Controller
{

  protected $messageRepository;

  public function __construct(MessageRepositoryInterface $messageRepository)
  {
    $this->messageRepository = $messageRepository;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Thread $thread)
  {
    if ($thread->users->contains(auth()->user()->id)) {
      return new MessageCollection($this->messageRepository->getByThread($thread));
    } else {
      throw new GeneralJsonException('Unauthorized', 403);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Thread $thread)
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Thread $thread, StoreRequest $request)
  {
    $message = $this->messageRepository->save($thread, $request->validated());
    broadcast(new SendMessage($thread, $message))->toOthers();
    return new MessageResource($message->load(['user', 'thread']));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
