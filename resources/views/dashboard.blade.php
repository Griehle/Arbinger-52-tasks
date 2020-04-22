
@extends('layouts.master')
@section('content')
@include('includes.message-block')

@if(Auth::user()->updated_at === NULL)
    <button class="btn btn-default "><a href="{{ route('changePassword') }}">Change my Password Please</a> </button>
@else

    {{--=====================================================================================================================
        ===========================Left side of screen dashboard view =======================================================
        =====================================================================================================================--}}

<p class="text-center superWow" id="superWow">W.O.W.</p>
<h1 class="text-center">DASHBOARD</h1>
    <section class="row">
        <div class = "col-md-6 text-center dashBoard-left">
            <header class="dheader">
                <h3>What do you have to say?</h3>
            </header>
            <form action ='{{route('post.create')}}'>
                <div class="form-group">

                    <input type="text" class="taskText" name="task_Body" value="">
                    <input type="hidden" class="task_id" name="task_id" value="">

                    <textarea class="form-control op" name="new-post" cols="6" placeholder="Your Post here" ></textarea>
                    <button type="submit" class="btn submit-nef2 dbutton">Submit post</button>
                    <input type="hidden" value="{{Session::token()}}">
                </div>
            </form>
            <p class="text-left">
                <button class="btn btn-info btn-sm changeDisplay">HELP</button>
                <ol class="instructions hide" >
                    <li>Click Select exercise to get task</li>
                    <li>Click "Save for later posting" to save while you accomplish your task</li>
                    <li>Click "Attach to post", write about your experience in "Your post here" box.</li>
                    <li>Click Submit post to create a styled post</li>
                    <li>Comment and "Like" other postings</li>
                </ol>
            </p>
            <div>
                <p><a class="fetchTask" href="#" >Select Exercise &rsaquo;</a></p>
                <br>
                <div class="hidden margin20">
                    <article class="border">
                        <form action="{{route('saveTask')}}">
                            <p class="taskToday" name="mattersNot" ></p>
                            <input type="hidden" class="taskToday" name="taskToday" value="">
                            <button type="submit" class="submitTask">Save for later posting</button>
                                <input type="hidden" value="{{Session::token()}}">
                            {{--<button id='postTask'>Create Post</button>--}}
                        </form>
                    </article>
                </div>
                <hr>
                <div>
                    <ul>
                        @foreach($tasks as $taskitem)
                            <div>
                                <li data-task-Id="{{$taskitem->id}}" class="taskList">
                                    <p>{{$taskitem->task_Body}}</p>

                                    <input type="hidden" value="{{$taskitem->employee_id}}" />
                                    <br>
                                    @if(Auth::user()->id == $taskitem->employee_id)
                                        <button>
                                            <a href="{{route('task.delete', ['task_id' => $taskitem->id])}}">Delete</a>
                                        </button>
                                        <button>
                                            <a data-task-Id="{{$taskitem->id}}" class="taskAttach">Attach to post</a>
                                        </button>
                                    @endif
                                    <hr>
                                </li>
                            </div>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>

        {{--=====================================================================================================================
            ===========================Right side of screen dashboard view ======================================================
            =====================================================================================================================--}}

         <div class = "col-md-6">
            <header class="dheader">
                <h3>Recent posts</h3>
            </header>
                @foreach($posts as $post)
                    <article class="posts " data-postId="{{ $post->id }}">
                        @isset($post->task_Body)
                            <div class="row">
                                <p class="post-task">{{$post->task_Body}}</p>
                            </div>
                        @endisset
                        <p>
                            <table>
                                <tr>
                                    <td><span class="marginR10" style="float: left; max-width: 100px;"><img class="postImage " src="{{ asset('storage/employees/'.$post->user->name .'.png') }}"></span></td>
                                    <td><span class="clearAll postBody">{{$post->body}}</span></td>
                                </tr>
                            </table>

                        </p>
                              <div class="info text-center">
                                  Posted by {{ $post->user->name }} on {{ $post->created_at->format('m/d/Y') }}
                                  <span class="text-left"> LIKES :  {{ \App\Http\Controllers\LikeController::getLikeCount($post->id) }}</span>﻿
                              </div>

                      <div class="interaction text-center" id="p{{$post->id}}">
                                  <a id="{{$post->id}}" href="#" class="like" onclick="like({{$post->id}})">{{Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->likes == 1 ? 'You Liked' : 'Like' : 'Like'}}</a>
                          | <a href="#" class="moveRight cmnt"  data-postId="comment({{$post->id}})">Comment </a> |
                            @if(Auth::user() == $post->user)
                                <a href="#" class="edit moveRight"  data-postId="{{$post->id}}">Edit</a> |
                                <a href="{{route('post.delete', ['post_id' => $post->id])}}">Delete</a>
                            @endif
                        </div>


                        @foreach ($post->comment as $comment)
                                <div class="comment">
                                    <p class="pad5 cmntBody"></p>
                            <p><span class ="marginR10 pad5" style="float: left; max-width: 100px;" ><img class="commentImage " src="{{ asset('storage/employees/'.$comment->user['name'] .'.png') }}"></span></p>
                                    <p class="pad5 cmntBody">{{ $comment->body}}</p>
                            @if(Auth::user() == $comment->user)
                                <a href="{{route('comment.delete', ['comment_id' => $comment->id])}}">Delete</a>
                            @endif
                            </div>
                        @endforeach
                    </article>
                @endforeach

         </div>
        <div class="col-md-1"></div>
    </section>

    {{--=====================================================================================================================
        ===========================  Modal for editing posts ================================================================
        =====================================================================================================================--}}

<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Post</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body text-left">
                <form style="text-align: left;">
                    <div class="form-group">
                        <label for="post-body">Edit the Post</label>
                        <textarea class="form-control text-left" name="post-body" id="post-body" ></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{--=====================================================================================================================
    ===========================  Modal for commenting posts ================================================================
    =====================================================================================================================--}}

<div class="modal fade" tabindex="-1" role="dialog" id="comment-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Comment on Post</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body text-left">
                <form style="text-align: left;">
                    <div class="form-group">
                        <label for="comment-body">Comment</label>
                        <textarea class="form-control text-left" name="comment-body" id="comment-body" ></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="comment-save">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endif
<script>

    var token       = '{{Session::token()}}';
    var urlEdit     = '{{route('edit')}}';
    var urlLike     = '{{route('likes')}}';
    var urlTask     = '{{route('task')}}';
    var urlComment  = '{{route('saveComment')}}';

</script>


@endsection
