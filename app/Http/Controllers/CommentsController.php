<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function store(){
        $postid = $_POST['postId'];
        $comment = new Comment(['body' => $_POST['commentBody'],  'user_id'=> Auth::id(), 'post_id'=>$postid ]);

        $post = Post::find($postid);

        $post->comment()->save($comment);
    }

    public function commentlist(){
        $user   = Auth::user();
        $userId = $user->id;

        $posts = Post::orderBy('created_at', 'desc')->get();
        $postId = $posts->id;
        $comment = Comment::where('post_id', $postId )->get();

        return view('dashboard', compact('comments', $comment));
    }

    public function delete($comment_id){
        $comment = Comment::where('id', $comment_id)->first();
        $comment->delete();
        return redirect()->route('taskList')->with(['message'=>'Successfully deleted']);
    }

}
