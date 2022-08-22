<?php

namespace App\Http\Controllers;

use App\Http\Requests\Thread\StoreRequest;
use App\Http\Resources\ParticipantCollection;
use App\Http\Resources\ThreadCollection;
use App\Http\Resources\ThreadResource;
use App\Models\Thread;
use App\Repositories\Interfaces\ThreadRepositoryInterface;
use Illuminate\Http\Request;

class ThreadController extends Controller
{

  private $threadRepository;

  public function __construct(ThreadRepositoryInterface $threadRepository)
  {
    $this->threadRepository = $threadRepository;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return new ThreadCollection($this->threadRepository->all());
  }

  public function participants($id)
  {
    return new ParticipantCollection(Thread::forAuthenticatedUser()->findOrFail($id)->users);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreRequest $request)
  {
    return new ThreadResource($this->threadRepository->save($request->validated()));
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
