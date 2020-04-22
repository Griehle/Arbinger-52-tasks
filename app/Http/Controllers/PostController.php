<?php

namespace App\Http\Controllers;

use App\likes;
use App\Post;
use App\Task;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class PostController extends Controller {


	public function getDashboard(){
        $user   = Auth::user();
        $userId = $user->id;

        $posts = Post::orderBy('created_at', 'desc')->get();
        $tasks = Task::where('employee_id', $userId )->get();

        return view('dashboard', compact('posts', 'tasks'));
	}

	public function postCreatePost( Request $request ) {
		$this->validate( $request, [
			'new-post' => 'required|max:1000',
            'task_Body' => 'sometimes | max:1000'
		] );
		$post                   = new Post();
		$post->body             = $request['new-post'];
        $post->task_Body        = $request['task_Body'];
		if($post->task_Body){
            $post->task_Body    = $request['task_Body'];
            $task_id            = $request['task_id'];
        }
		$message            = 'There was an error';

		if ( $request->user()->posts()->save( $post ) ) {
            if($post->task_Body) {
                TaskController::TaskDelete($task_id);
            }
			$message = 'Post created successfully!';
		}

		return redirect()->route( 'dashboard' )->with( [ 'message' => $message ] );
	}

/*	public function createTaskDisplay(){
        $this->validate( $request, [
            'new-task' => 'required'
        ] );
    }*/

	public function getPostDelete($post_id){

		$post = Post::where('id', $post_id)->first();
		if (Auth::user() != $post->user){
			return redirect()->back();
		}
		$post->delete();
		return redirect()->route('dashboard')->with(['message'=>'Successfully deleted']);
	}

	public function postEditPost(Request $request){
		$this->validate($request,[
			'postBody'=>'required'
		]);
		$post = Post::find($request['postId']);
		if (Auth::user() != $post->user){
			return redirect()->back();
		}
		$post->body = trim($request['postBody']);
		$post->update();
		return response()->json(['newBody' => $post->body], 200);
	}

	public function postLikePost(Request $request){
		$post_id = $request['postId'];
		$is_like = $request['isLike'] === 'true' ? true: false;
		$update = false;
		$post = Post::find($post_id);
		if(!$post){
			return null;
		}

		$user = Auth::user();
		$like = $user->likes()->where('post_id', $post_id )->first();

        if ($like) {
            $like_value = $like->likes;
            $update = true;
            if ($like->likes == $is_like) {
                $like->delete();
                return null;
            }
            }else{
                $like = new Likes();
            }
            $like->likes = $is_like;
            $like->user_id = $user->id;
            $like->post_id = $post->id;

            if($update){
                (array)$like->update();
            }else{
                (array)$like->save();
            }
            return null;
	}

	public function postLikeCount(Request $request){
        $post_id = $request['postId'];
        $likeCount = Likes::where('likes', '=', $post_id)->count();
        return $likeCount;
    }

    public function findPostTask($post_id){
        $post       = Post::where('id', $post_id)->first();
        $taskId     = $post->task_id;
        $task       = Task::where('id', $taskId)->first();
        $taskPost   = $task->body;
        return response()->json(['taskBody' => $taskPost], 200);
    }

    public function findPostComment($post_id){
        $post           = Post::where('id', $post_id)->first();
        $commentId      = $post->task_id;
        $comment        = Comment::where('id', $commentId);
        $commentPost    = $comment->body;
        return response()->json(['commentBody' => $commentPost], 200);
    }


}