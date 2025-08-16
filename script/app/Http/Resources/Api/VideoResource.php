<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'description' => $this->description,
            'slug' => $this->slug,
            'video_type' => $this->video_type,
            'video_url' => $this->video_type === 'url' ? $this->url : ($this->file_path ? url($this->file_path) : url($this->url)),
            'thumbnail_url' => $this->thumbnail_url ? url($this->thumbnail_url) : null,
            'cta_label' => $this->cta_label,
            'cta_url' => $this->cta_url,
            'views' => $this->view,
            'created_at' => $this->created_at->toIso8601String(),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
