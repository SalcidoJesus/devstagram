@extends('layout.app')

@section('titulo')
	Restaurar contraseña
@endsection


@section('contenido')
	<div class="md:flex md:justify-center">
		 <div class="md:w-1/2 bg-white shadow p-6">

			<form action="{{ route('password.email') }}" class="mt-10 md:mt-0" method="POST" enctype="multipart/form-data">
				@csrf


				@if ( session('mensaje') )
					<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
						{{ session('mensaje') }}
					</p>
				@endif



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


				<input type="submit" value="Restaurar contraseña" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">


			</form>

		 </div>
	</div>
@endsection
