<?php

namespace App\Http\Resources;

use App\Models\MessageRoom;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'code' => $this->code,
            'users_id' => new UsersResource(User::findOrFail($this->users_id)),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'chat' => MessageRoom::wherecode($this->code)->get(),
        ];
    }
}
