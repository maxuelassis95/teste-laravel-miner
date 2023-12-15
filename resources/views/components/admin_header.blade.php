<h2>Dashboard do administrador</h2>

@if (auth()->check())
    Olá {{ auth()->user()->name }} <a href="{{ route('login.destroy') }}">Sair</a>
@endif

<ul>
    <li><a href="{{ route('admin.dashboard') }} ">Inicio</a></li>
    <li><a href="{{ route('admin.manage_users') }} ">Gerenciar usuarios</a></li>
    <li><a href="{{ route('admin.manage_permissions') }}">Gerenciar permissões</a></li>
</ul>
