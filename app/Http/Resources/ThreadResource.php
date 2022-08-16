<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThreadResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'message' => MessageResource::make($this->whenLoaded('lastMessage')),
      'participants' => $this->whenLoaded('users', function () {
        return $this->users->pluck('nickname');
      })
    ];
  }
}
