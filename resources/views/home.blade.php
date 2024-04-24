
@extends('layout.app')

@section('titulo')
	Página principal
@endsection

@section('contenido')

	<x-listar-post :posts="$posts"/>

@endsection
