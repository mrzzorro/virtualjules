<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoItem extends Model
{
    protected $fillable = [
        'photo_id', 'file_path', 'order'
    ];

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }
}