<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
       return [
           'id' => $this->id,
           'name' => $this->name,
           'second_name' => $this->second_name,
           'third_name' => $this->third_name,
           'first_lastname' => $this->first_lastname,
           'second_lastname' => $this->second_lastname,
           'married_surname' => $this->married_surname,
           'username' => $this->username,
           'institution_id' => $this->institution_id,
           'email' => $this->email,
           'roles' => RoleResource::collection($this->whenloaded('roles')),
           'permissions' => PermissionResource::collection($this->whenloaded('permissions')),
       ];
    }
}
