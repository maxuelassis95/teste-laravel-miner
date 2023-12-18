<h2>Dashboard do administrador</h2>

@if (auth()->check())
    Olá {{ auth()->user()->name }} <a href="{{ route('login.destroy') }}">Sair</a>
@endif

<ul>
    <li><a href="{{ route('admin.dashboard') }} ">Inicio</a></li>
    <li><a href="{{ route('admin.manage_users') }} ">Gerenciar usuarios</a></li>
    <li><a href="{{ route('admin.manage_permissions') }}">Gerenciar permissões</a></li>
</ul>

<style>
    /* Adicione a regra CSS ao cabeçalho da sua view */
    button:hover {
        cursor: pointer;
    }

    .link-create-user {
        padding: 15px;
        border: 1px #333 solid;
        margin-top: 20px;
        display: block;
        background-color:aquamarine;
        color:black;
        text-align: center;
    }
</style>
