@extends('layout')

@section('content')
    <a href="{{ route('home') }}"> Home </a>

    <h2>Login</h2>

    <form action="{{ route('login.trylogin') }}" method="POST">
        @csrf

        <span>Email: </span>
        <input type="text" name="email" value="baron84@example.net">
        <span>Senha: </span>
        <input type="password" name="password" id="" value="12345">

        <div class="error">
            @error('email')
                {{ $message }}
            @enderror

            @error('password')
                {{ $message }}
            @enderror

            @error('error')
                {{ $message }}
            @enderror
        </div>

        <button type="submit"> Entrar </button>

    </form>
@endsection
