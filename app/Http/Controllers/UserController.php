<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller{
	public function postSignUp(Request $request){
		$this->validate($request, [
			'email'=>'required|email|unique:users',
			'name'=>'required|max:60',
			'password'=>'required|min:8|max:120'
		]);

		$email = $request['email'];
		$name = $request['name'];
		$password = bcrypt($request['password']);

		$user = new User();
		$user->email = $email;
		$user->name = $name;
		$user->password = $password;
		$user->save();
		Auth::login($user);

		return redirect()->route('taskList');
	}
	public function postSignIn(Request $request){

		$this->validate($request, [
			'email'=>'required',
			'password'=>'required'
		]);

		if (Auth::attempt(['email'=> $request['email'],'password'=> ($request['password'])])){
			return redirect()->route('taskList');
		}
			return redirect()->back();
	}

	public function getAccount(){
		return view('account', ['user'=>Auth::user()]);
		//var_dump(Auth::user());
	}

	public function saveAccount(Request $request){
		$this->validate($request, [
			'name'=>'required|max:60|unique:users',
		]);

		$user = Auth::user();
		$user->name = $request['name'];
		$user->update();
		$file = $request->file('image');
		$filename = $request->name . '-' . $user->id . '.jpg';
		if($file)
		{
			//$file->storeAs('local', $filename);
			Storage::disk('local')->put($filename, File::get($file));
		}﻿;

		return redirect()->route('dashboard');

	}

	public function getUserImage ($filename){
		$file = Storage::disk('local')->get($filename);
		return new response($file, 200);
	}

	public function getLogout(){
		Auth::logout();
		return  redirect()->route('home');

	}


}