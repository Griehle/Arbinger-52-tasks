@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')
    @include('includes.message-block')

    <div class="row">
        {{-- <div class="col-md-6" @v-if="isAdmin">
             <h3>Sign Up</h3>
             <form action="{{ route('signup') }}" method="post">
                 <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                     <label for="email">Your E-Mail</label>
                     <input class="form-control {{ $errors->has('password') ? 'has-error' : '' }}" type="text" name="email" id="email" value="{{ Request::old('email') }}">
                 </div>
                 <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     <label for="name">Your Legal Name</label>
                     <input class="form-control" type="text" name="name" id="name" value="{{ Request::old('name') }}">
                 </div>
 --}}{{--                <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
                     <label for="display_name">Your Display Name</label>
                     <input class="form-control" type="text" name="display_name" id="display_name" value="{{ Request::old('display_name') }}">
                 </div>--}}{{--
                 <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                     <label for="password">Your Password</label>
                     <input class="form-control" type="password" name="password" id="password" value="">
                 </div>
                 <button type="submit" class="btn btn-primary">Submit</button>
                 <input type="hidden" name="_token" value="{{ Session::token() }}">
             </form>
         </div>--}}
        <div class="col-md-4 col-md-offset-2">
            <h3>Sign In</h3>
            <form action="{{ route('login') }}" method="post">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Your E-Mail</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email') }}">
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password') }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>
@endsection