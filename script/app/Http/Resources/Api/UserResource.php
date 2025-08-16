<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'username' => $this->username,
            'slug' => $this->slug,
            'image_url' => url($this->image),
        ];
    }
}
