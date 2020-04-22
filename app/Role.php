<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class role extends Model
{
    //
	public function roles(){
		return $this->belongsToMany('App/Role');
	}

	public function user()
	{
		return $this
			->belongsToMany('App\User')
			->withTimestamps();
	}
}
