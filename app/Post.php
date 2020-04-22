<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = array('task_Body', 'new-post', 'task_id');

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function task(){
        return $this->belongsToMany('App\Task');
    }

    public function task_Body(){
        return $this->belongsTo('App\Post');
    }

    public function comment(){
        return $this->hasmany('App\Comment');
    }

}
