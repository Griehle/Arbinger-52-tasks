<?php
namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use Notifiable;

    public function user(){
        $this->belongsToMany('App/User');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }
    public function likes(){
        return $this->hasMany('App\Likes');
    }
    public function comment(){
        return $this->hasmany('App\Comment');
    }
}
