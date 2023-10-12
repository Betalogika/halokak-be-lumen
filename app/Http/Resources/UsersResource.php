<?php

namespace App\Http\Resources;

use App\Models\Profile;
use App\Models\RoleModels;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            "id" => $this->id,
            "username" => $this->username,
            "email" => $this->email,
            "verify" => $this->verify,
            "role_id" => RoleModels::findOrFail($this->role_id),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            'profile' => Profile::whereusers_id($this->id)->first(),
        ];
    }
}
