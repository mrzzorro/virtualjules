<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'photo_type' => $this->photo_type,
            'cta_label' => $this->cta_label,
            'cta_url' => $this->cta_url,
            'is_approved' => $this->is_approved,
            'created_at' => $this->created_at->toIso8601String(),
            'user' => new UserResource($this->whenLoaded('user')),
            'image_url' => $this->when($this->photo_type === 'single', url($this->file_path)),
            'images' => $this->when($this->photo_type === 'carousel', $this->photoItems->map(function ($item) {
                return ['id' => $item->id, 'url' => url($item->file_path)];
            })),
            'likes_count' => $this->when(isset($this->likes_count), $this->likes_count),
        ];
    }
}
