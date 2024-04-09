<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		return view('perfil.index');
	}

	public function store( Request $request ) {

		$request -> request -> add([
			'username' => Str::slug($request -> username)
		]);



		// validamos campos
		// más reglas: 'not_in:twitter,otro', 'in:perro'
		$this -> validate($request, [
			'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:30', ],
			'email' => ['required', 'unique:users,email,'.auth()->user()->id, 'email', 'max:60']
		]);



		// imagen
		if ($request -> imagen) {
			$imagen = $request -> file('imagen');

			$nombreImagen = Str::uuid() . "." . $imagen -> extension();

			$imagenServidor = Image::make( $imagen );
			$imagenServidor -> fit( 1000, 1000 );

			$imagenPath = public_path('perfiles') . '/' . $nombreImagen;
			$imagenServidor -> save( $imagenPath );
		}


		$cambiar_contra = false;
		// hay contraseña?
		if ($request -> password_actual) {

			// es la contra real?
			if ( auth() -> attempt( $request -> only( 'email', 'password' ) ) ) {

				// la nueva, tiene el formato correcto?
				$this -> validate($request, [
					'password' => 'required|confirmed|min:8'
				]);
				$cambiar_contra = true;

			} else {

				return back() -> with('mensaje', 'Credenciales incorrectas');

			}

		}



		// guardar cambios
		$usuario = User::find( auth()->user()->id );
		$usuario -> username = $request->username;
		$usuario -> email = $request->email;
		if ($cambiar_contra) {
			$usuario -> password = Hash::make( $request -> password );
		}
		$usuario -> imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
		$usuario -> save();

		return redirect()->route( 'posts.index', $usuario );

	}

}
