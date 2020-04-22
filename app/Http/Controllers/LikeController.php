<?php

namespace App\Http\Controllers;

use App\Likes;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public static function getLikeCount($postId) {
       $likeCount =  Likes::where([
                                    ['likes', '=', 1],
                                    ['Post_id', '=', $postId]
                                    ])->count();
        return  $likeCount;
    }
}
