@extends('layout')

@section('content')



 <h2>Inicio</h2>

@if (auth()->check())

Olá {{ auth()->user()->name }}<a href="{{route('login.destroy');}}"> Sair </a>

@else

<a href="{{ route('login.index') }}"> Login </a>

@endif

@endsection
