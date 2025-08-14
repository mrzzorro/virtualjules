<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'slug', 'url', 'video_type', 'thumbnail_url', 'file_path', 'status', 'view', 'country', 'cta_label', 'cta_url', 'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function favourite_to_user()
    {
    	return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function comments()
    {
    	return $this->HasMany('App\Comment');
    }
}
