<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //

	public function store( User $user ) {

		// la variable $user viene de la url, y el auth es el de la sesión
		// entonces no se porque se llenan así ;n;
		$user->followers()->attach( auth()->user()->id );

		return back();

	}

	public function destroy( User $user ) {

		// la variable $user viene de la url, y el auth es el de la sesión
		// entonces no se porque se llenan así ;n;
		$user->followers()->detach( auth()->user()->id );

		return back();

	}
	
}
