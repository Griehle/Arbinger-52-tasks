
@extends('layouts.master')
@section('content')
@include('includes.message-block')

{{--Left side of screen dashboard view--}}
<h1 class="text-center">DashBoard</h1>
    <section class="row">

        <div class = "col-md-6 text-center">
            <header class="dheader">
                <h3>What do you have to say?</h3>
            </header>
            <form action ='{{route('post.create')}}'>
                <div class="form-group">
                    <textarea class="form-control" name="new-post" id="new-post" cols="6" placeholder="Your Post here" ></textarea>
                    <button type="submit" class="btn btn-primary dbutton">Submit post</button>
                    <input type="hidden" value="{{Session::token()}}">
                </div>
            </form>
        </div>

{{--right side of screen on dashboard view--}}

         <div class = "col-md-6 text-center">
            <header class="dheader">
                <h3>Whats going on</h3>
            </header>
{{--                @foreach($posts as $post)
                    <article class="posts" data-postId="{{$post->id}}">

                        <p>
                            {{$post->body}}
                        </p>
                        <div class="info">
                            Posted by {{$post->user->display_name}} on {{ $post->created_at->format('m/d/Y')}}﻿
                        </div>

                        <div class="interaction">
                                <a href="#" class="like">{{Auth::user()->likes()->where('post_id', $post->id)->first() ?Auth::user()->likes()->where('post_id', $post->id)->first()->likes == 1 ? 'Liked' : 'Like' : 'Like'}}</a>
                                <a href="#" class="like"> {{Auth::user()->likes()->where('post_id', $post->id)->first() ?Auth::user()->likes()->where('post_id', $post->id)->first()->likes == 0 ? 'Disliked' : 'Dislike' : 'Dislike'}}</a>
                            @if(Auth::user() == $post->user)
                                <a href="#" class="edit" data-postId="{{$post->id}}">Edit</a> |
                                <a href="{{route('post.delete', ['post_id' => $post->id])}}">Delete</a>
                            @endif
                        </div>
                    </article>
                @endforeach--}}

         </div>
        {{--<div class="col-md-1"></div>--}}
    </section>

<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Post</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="post-body">Edit the Post</label>
                        <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
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
<script>
    var token = '{{Session::token()}}';
    var urlEdit = '{{route('edit')}}';
    var urlLike = '{{route('likes')}}';
</script>
@endsection