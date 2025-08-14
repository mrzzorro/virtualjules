<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoComment extends Model
{
    protected $table = 'photo_comments';

        public function photo()
    {
    	return $this->belongsTo('App\Photo');
    }

    public function replies() {
	    return $this->hasMany('App\PhotoComment', 'parent_id');
	}

	public function main_comment()
	{
		return $this->belongsTo('App\PhotoComment', 'parent_id');
	}

	public function mention_user()
	{
		return $this->belongsTo('App\User', 'mention_id');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function favourite_to_user()
    {
    	return $this->belongsToMany('App\User')->withTimestamps();
    }
}
