<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
      'body' => $this->body,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'user' => $this->whenLoaded('user', UserResource::make($this->user)),
    ];
  }
}
