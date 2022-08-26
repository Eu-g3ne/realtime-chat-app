<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\StoreRequest;
use App\Http\Requests\Message\UpdateRequest;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\Thread;
use App\Repositories\Interfaces\MessageRepositoryInterface;
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
    return new MessageCollection($this->messageRepository->getByThread($thread));
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
    return new MessageResource($message->load('user'));
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
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Thread $thread, Message $message, UpdateRequest $request)
  {
    $message = $this->messageRepository->update($thread, $message, $request->validated());
    return new MessageResource($message->load('user'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Thread $thread, Message $message)
  {
    $message = $this->messageRepository->delete($message);
    return new MessageResource($message);
  }
}
