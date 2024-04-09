<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{

	public function store( Request $request, Post $post ) {

		/*
			a lo que entiendo, el post viene en la variabler $post
			y, de alguna manera extraña, lo obtiene por defecto, supongo que por la ruta
			entonces ya que la obtiene, lo guada en el create
			y ya nomas le pasamos el user_id
		*/
		$post->likes()->create([
			'user_id' => $request -> user() -> id
		]);

		return back();
	}

	public function destroy( Request $request, Post $post ) {
		$request->user()->likes()->where( 'post_id', $post->id )->delete();

		return back();
	}

}
