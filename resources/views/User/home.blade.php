@extends('layout')

@section('content')
    <h2>Dashboard do usuário</h2>

    @if (auth()->check())
        Olá {{ auth()->user()->name }} <a href="{{ route('login.destroy') }}">Sair</a>

        <!-- verifica as permissões que o usuario tem, e mostra links para telas de
            acordo com o que ele pode fazer -->

        <ul>
            @if(auth()->user()->hasPermission('manage_brands'))
                <li><a href="{{ route('user.manage_brands') }}">Gerenciar Marcas</a></li>
            @else
            <li>Gerenciar Marcas | Sem permição</li>
            @endif

            @if(auth()->user()->hasPermission('manage_categories'))
                <li><a href="{{ route('user.manage_categories') }}">Gerenciar Categorias</a></li>
                @else
            <li>Gerenciar categrias | Sem permição</li>
            @endif

            @if(auth()->user()->hasPermission('manage_products'))
                <li><a href="{{ route('user.manage_products') }}">Gerenciar Produtos</a></li>
                @else
            <li>Gerenciar produtos | Sem permição</li>
            @endif
        </ul>

    @endif
@endsection
