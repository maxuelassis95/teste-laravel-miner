@extends('layout')

@section('content')

@if (auth()->check())
    Olá {{ auth()->user()->name }} <a href="{{ route('login.destroy') }}">Sair</a>

    <h2>Configuração de produtos</h2>

    <ul>
        @if(auth()->user()->hasPermission('manage_brands'))
            <li><a href="{{ route('user.manage_brands') }}">Gerenciar Marcas</a></li>
        @else
            <li>Gerenciar Marcas | Sem permissão</li>
        @endif

        @if(auth()->user()->hasPermission('manage_categories'))
            <li><a href="{{ route('user.manage_categories') }}">Gerenciar Categorias</a></li>
        @else
            <li>Gerenciar Categorias | Sem permissão</li>
        @endif

        @if(auth()->user()->hasPermission('manage_products'))
            <li><a href="{{ route('user.manage_products') }}">Gerenciar Produtos</a></li>
        @else
            <li>Gerenciar Produtos | Sem permissão</li>
        @endif
    </ul>
@endif

@endsection
