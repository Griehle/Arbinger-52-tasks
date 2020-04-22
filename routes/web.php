<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;

Route::get('/', function () {
	return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('/auth/login');
})->name('login');

Route::post('/signup', [
	'uses' => 'UserController@postSignUp',
	'as'=>'signup'
]);

Route::get('/dashboard', [
    'uses' => 'TaskController@taskList',
	'as'=>'dashboard',
])->middleware('auth');

Route::post('/signin', [
	'uses' => 'UserController@postSignIn',
	'as'=>'signin'
]);

Route::get('/createpost', [
	'uses' => 'PostController@postCreatePost',
	'as' => 'post.create',
	'middleware' => 'auth'
]);

Route::get('/delete-post/{post_id}', [
	'uses' => 'PostController@getPostDelete',
	'as' => 'post.delete',
	'middleware' => 'auth'
]);

Route::post('/edit',[
    'uses'=> 'PostController@postEditPost',
    'as'=>'edit'
]);

Route::get('/logout',[
	'uses' =>'UserController@getLogout',
	'as'=>'get.logout'
]);

Route::get('/account', [
	'uses'=>'UserController@getAccount',
	'as'=>'account'
]);

Route::post('/updateAccount', [
	'uses' => 'UserController@saveAccount',
	'as' => 'account.update'
	]);

Route::get('/userImage/{filename}', [
	'uses'=>'UserController@getUserImage',
	'as'=> 'account.image'
]);


Route::post('/likes', [
	'uses'=>'PostController@postLikePost',
	'as'=>'likes'
]);

Route::get('/countLikes/{post_id}', [
    'uses'=>'LikeController@getLikeCount',
    'as'=>'likes.count'
]);

Route::get('/task', [
    'uses'=>'TaskController@getTask',
    'as'=>'task'
]);

Route::get('/saveTask', [
    'uses' => 'TaskController@saveTask',
    'as'=> 'saveTask',
]);

Route::get('/attachTask/{task_id}', [
   'uses' => 'TaskController@attachTask'
]);

Route::get('/taskList', [
    'uses' => 'TaskController@taskList',
    'as'=> 'taskList',
])->middleware('auth');

Route::get('/getPostTask/{post_id}', [
   'uses' => 'PostController@findPostTask',
   'as'   => 'getPostTask'
]);

Route::get('/delete-task/{post_id}', [
    'uses' => 'TaskController@TaskDelete',
    'as' => 'task.delete',
    'middleware' => 'auth'
]);

Route::get('/dailyDigest', [
   /*'users'  => 'users',*/
   'uses'   => 'DailyDigestController@getEmailList',
   'as'     => 'dailyDigest'
]);

//============ commenting routes =================
/*Route::get('/post/{id}', 'PostController@findPostComment')->name('posts.show'); */

Route::get('/comment', [
    'uses'=>'CommentController@getComment',
    'as'=>'comment',
]);

Route::post('/saveComment', [
    'uses' => 'CommentsController@store',
    'as'=> 'saveComment',
], function(){
    $user = App\User::first();
    $user->notify(new CommentOnPost);
    return 'Done';
});

Route::get('/delete-comment/{comment_id}', [
    'uses' => 'CommentsController@delete',
    'as' => 'comment.delete',
    'middleware' => 'auth'
]);

/*Route::get('/', function() {
    $user = App\User::first();

    $user->notify(new CommentOnPost);

    return 'Done';
});*/

//=============== end commenting routes ==========

Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

Auth::routes();

