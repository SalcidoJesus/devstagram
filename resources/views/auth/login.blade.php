@extends('layout.app')

@section('titulo')
	Inicia Sesión en DevStagram
@endsection

@section('contenido')
	<div class="md:flex justify-center md:gap-10 md:items-center">

		{{-- un lado --}}
		<div class="md:w-6/12 p-5">
			<img src="{{ asset('img/login.jpg') }}" alt="Registro de usuarios">
		</div>


		{{-- el otro lado --}}
		<div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
			<form method="POST" action="{{route('login')}}">
				@csrf



				@if ( session('mensaje') )
					<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
						{{ session('mensaje') }}
					</p>
				@endif

				{{-- nombre de la persona --}}
				<div class="mb-5">
					<label for="email" class="mb-2 block uppercase to-gray-500 font-bold">
						Email
					</label>
					<input
						id="email"
						name="email"
						type="email"
						placeholder="Tu Email"
						value="{{ old('email') }}"
						class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror">
					@error('email')
						<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				</div>

				{{-- correo de la persona --}}
				<div class="mb-5">
					<label for="password" class="mb-2 block uppercase to-gray-500 font-bold">
						Contraseña
					</label>
					<input
						id="password"
						name="password"
						type="password"
						placeholder="Tu Contraseña"
						class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
					@error('password')
						<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
					@enderror
				</div>


				<div class="mb-5 flex gap-2">
					<input type="checkbox" name="remember" id="remember">
					<label for="remember" class="text-gray-500 text-sm select-none">
						Mantener mi sesión
					</label>
				</div>


				<input type="submit" value="Iniciar sesión" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

			</form>
		</div>

	</div>
@endsection
