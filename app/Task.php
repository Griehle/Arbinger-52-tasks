<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function task_Body(){
        return $this->belongsTo('App\Post');
    }

}
