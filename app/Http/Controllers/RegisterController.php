<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class RegisterController extends Controller
{
	//
	public function index()
	{
		return view('auth.register');
	}

	public function store(Request $request)
	{
		// solicitud y datos específicos
		// dd($request);
		// dd($request->get('username'));


		$request -> request -> add([
			'username' => Str::slug($request -> username)
		]);


		$this -> validate($request, [
			'name' => 'required|min:5',
			'username' => 'required|unique:users|min:3|max:30',
			'email' => 'required|unique:users|email|max:60',
			'password' => 'required|confirmed|min:8'
		]);


		User::create([
			'name' => $request -> name,
			'username' => $request -> username,
			'email' => $request -> email,
			'password' => Hash::make( $request -> password ),
		]);


		// auth()->attempt([
		// 	'email' => $request -> email,
		// 	'password' => $request -> password,
		// ]);

		auth()->attempt( $request->only('email', 'password') );

		return redirect()->route('posts.index', [
			'user' => auth()->user()
		]);

	}

	public function forgotPassword(Request $request) {
		$request->validate(['email' => 'required|email']);

		$status = Password::sendResetLink(
			$request->only('email')
		);

		return $status === Password::RESET_LINK_SENT
					? back()->with(['status' => __($status)])
					: back()->withErrors(['email' => __($status)]);
	}

}
