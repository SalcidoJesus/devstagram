@extends('layout.app')

@section('titulo')
	Editar perfil
@endsection


@section('contenido')
	<div class="md:flex md:justify-center">
		 <div class="md:w-1/2 bg-white shadow p-6">

			<form action="{{ route('perfil.store') }}" class="mt-10 md:mt-0" method="POST" enctype="multipart/form-data">
				@csrf


				@if ( session('mensaje') )
					<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
						{{ session('mensaje') }}
					</p>
				@endif


				<div class="mb-5">
					<label for="username" class="mb-2 block uppercase to-gray-500 font-bold">
						Username
					</label>
					<input
						id="username"
						name="username"
						type="text"
						placeholder="Tu nombre de usuario"
						value="{{ auth()->user()->username }}"
						class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
					>

					@error('username')
						<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				</div>



				<div class="mb-5">
					<label for="email" class="mb-2 block uppercase to-gray-500 font-bold">
						Email
					</label>
					<input
						id="email"
						name="email"
						type="email"
						placeholder="Tu correo electrónico"
						value="{{ auth()->user()->email }}"
						class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
					>

					@error('email')
						<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				</div>


				<div class="mb-5">
					<label for="imagen" class="mb-2 block uppercase to-gray-500 font-bold">
						Foto de perfil
					</label>
					<input
						id="imagen"
						type="file"
						name="imagen"
						accept="image/*"
						class="border p-3 w-full rounded-lg"
					>

					@error('imagen')
						<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				</div>




				<div class="mb-5">
					<label for="password_actual" class="mb-2 block uppercase to-gray-500 font-bold">
						Contraseña actual
					</label>
					<input
						id="password_actual"
						name="password_actual"
						type="password"
						placeholder="Tu contraseña"
						class="border p-3 w-full rounded-lg @error('password_actual') border-red-500 @enderror"
					>

					@error('password_actual')
						<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				</div>




				{{-- contra nueva --}}
				<div class="mb-5">
					<label for="password" class="mb-2 block uppercase to-gray-500 font-bold">
						Contraseña nueva
					</label>
					<input
						id="password"
						name="password"
						type="password"
						placeholder="Tu contraseña nueva"
						class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
					@error('password')
						<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				</div>

				{{-- repetir contra --}}
				<div class="mb-5">
					<label for="password_confirmation" class="mb-2 block uppercase to-gray-500 font-bold">
						Repetir Contraseña
					</label>
					<input
						id="password_confirmation"
						name="password_confirmation"
						type="password"
						placeholder="Repite tu contraseña"
						class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror">
					@error('password_confirmation')
						<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				</div>


				<input type="submit" value="Actualizar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">


			</form>

		 </div>
	</div>
@endsection
