@extends('layouts.master-login')

@section('title')
    Welcome!
@endsection

@section('content')
@include('includes.message-block')

    <div class="row text-center" id="login-form">
        <div class="col-md-4 col-md-offset-4">
            <img src="{{ asset('storage/Nef-Vert-2-process-ticket.png') }}" id='login-logo' >
            <form action="{{ route('login') }}" method="post" >
                <div class=" {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input class="form-control" type="text" name="email" id="email" placeholder="email" value="{{ Request::old('email') }}">
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input class="form-control" type="password" name="password" id="password" placeholder="password" value="{{ Request::old('password') }}">
                </div>
                <button type="submit" class="btn submit-nef">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
{{--        <div>
            <div>
                <form action = "{{ route('reset') }}" method="get">
                    <button type="submit" class="btn btn-danger">reset password</button>
                </form>
            </div>
        </div>--}}
    </div>
@endsection