@extends('layout.app')

@section('titulo')
	{{ $post->titulo }}
@endsection


@section('contenido')
	<div class="container mx-auto md:flex">

		<div class="md:w-1/2">
			<img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}"/>

			<div class="p-3">
				<p>0 likes</p>
			</div>

			<div>
				<p class="font-bold">{{ $post->user->username }}</p>
				<p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
			</div>
		</div>



		<div class="md:w-1/2 p-5">
			<div class="shadow bg-white p-5 mb-5">

				@auth
				<p class="text-xl font-bold text-center mb-4">Agregar nuevo comentario</p>

				@if (session('mensaje'))
					<div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
						{{ session('mensaje') }}
					</div>
				@endif

				<form action="{{ route('comentarios.store', [ 'user' => $post->user, 'post' => $post ]) }}" method="post">
					@csrf
					<div class="mb-5">
						<label for="comentario" class="mb-2 block uppercase to-gray-500 font-bold">
							Agrega tu comentario
						</label>
						<textarea
							id="comentario"
							name="comentario"
							placeholder=""
							class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"></textarea>

						@error('comentario')
							<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
						@enderror
					</div>

					<input type="submit" value="Comentario" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

				</form>
				@endauth

				<div class="bg-white shadow mb-5 maxh-96 overflow-y-scroll mt-10">
					@if (count($post->comentarios) > 0)

					@foreach ($post->comentarios as $comentario)
							<div class="p-5 border-gray-300 border-b">
								<a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">{{ $comentario->user->username }}</a>
								<p>{{ $comentario->comentario }}</p>
								<p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
							</div>
						@endforeach

					@else
						<p class="p-10 text-center">No hay comentarios</p>
					@endif
				</div>

			</div>
		</div>
	</div>
@endsection
