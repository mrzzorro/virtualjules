<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'photo_type', 'file_path', 'cta_label', 'cta_url', 'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function photoItems()
    {
        return $this->hasMany('App\PhotoItem');
    }

    public function favourite_to_user()
    {
    	return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function comments()
    {
    	return $this->HasMany('App\PhotoComment');
    }
}