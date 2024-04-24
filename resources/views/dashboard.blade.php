@extends('layout.app')

@section('titulo')
	{{ $user -> username }}
@endsection


@section('contenido')

	<div class="flex justify-center">
		<div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">

			<div class="w-8/12 lg:w-6/12 px-5">

				@if ($user -> imagen)
					<img
						class="rounded-full"
						alt="Perfil de {{ $user -> username }}"
						src="{{ asset('perfiles/'.$user -> imagen) }}"
					>
				@else
					<img
						src="{{ asset('img/usuario.svg') }}"
						alt="Perfil de {{ $user -> username }}"
					>
				@endif
			</div>
			<div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-center py-10 md:py-10">
				<div class="flex items-center gap-2">
					<p class="text-gray-700 text-2xl">
						{{ $user -> username }}
					</p>

					@auth
						@if ($user -> id === auth() -> user() -> id)
							<a
								href="{{ route('perfil.index') }}"
								class="hover:text-gray-600 cursor-pointer"
							>
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
								</svg>
							</a>

						@endif
					@endauth
				</div>

				<p class="text-gray-800 text-sm mb-3 font-bold mt-5">
					{{ $user->followers->count() }}
					<span class="font-normal">
						@choice('seguidor|seguidores', $user->followers->count())
					</span>
				</p>

				<p class="text-gray-800 text-sm mb-3 font-bold">
					{{ $user->followings->count() }}
					<span class="font-normal">
						@choice('seguido|seguidos', $user->followings->count())
					</span>
				</p>

				<p class="text-gray-800 text-sm mb-3 font-bold">
					{{ $user->posts->count() }}
					<span class="font-normal">publicaciones</span>
				</p>

				@auth
					@if ( $user -> id !== auth() -> user() -> id )

						{{-- el perfil de este wey, es seguido por el de la sesión? --}}
						@if ( !$user->siguiendo( auth() -> user() ))


							<form action="{{ route('users.follow', $user) }}" method="POST">
								@csrf
								<input
									type="submit"
									value="Seguir"
									class="bg-sky-600 text-white rounded-lg px-3 py-1 font-bold uppercase cursor-pointer"
								/>
							</form>

						@else

							<form action="{{ route('users.unfollow', $user) }}" method="POST">
								@csrf
								@method('delete')
								<input
								type="submit"
								value="Dejar de seguir"
								class="bg-red-600 text-white rounded-lg px-3 py-1 font-bold uppercase cursor-pointer"
								/>
							</form>

						@endif

					@endif

				@endauth

			</div>

		</div>
	</div>


	<section class="container mx-auto mt-10">
		<h2 class="text-3xl text-center font-black my-10">Publicaciones</h2>
		<x-listar-post :posts="$posts"/>
	</section>

@endsection
