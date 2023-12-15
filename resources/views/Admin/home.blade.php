@extends('layout')

@section('content')
    <h2>Dashboard do administrador</h2>

    @if (auth()->check())
        Olá {{ auth()->user()->name }} <a href="{{ route('login.destroy') }}">Sair</a>

    @endif

@endsection
