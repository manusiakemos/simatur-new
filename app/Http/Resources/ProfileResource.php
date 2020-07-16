<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->avatar
            ? $avatar = asset("/images/avatars/$this->avatar")
            : $avatar = asset('https://api.adorable.io/avatars/285/abott@adorable.png');

        return array(
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => '',
            'password_confirmation' => '',
            'avatar' => $avatar,
            'role' => $this->role,
            'links' =>[
                'update' => route('profile.update'),
                'edit' => route('profile.edit'),
                'avatar' => route('profile.avatar'),
            ]
        );
    }
}
