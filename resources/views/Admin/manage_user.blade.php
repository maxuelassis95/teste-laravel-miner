@extends('layout')

@section('content')
    @include('components/admin_header')

    <a href="{{ route('admin.create_users') }}">Criar usuário</a>

    <h3>Listando todos usuários</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>É administrador?</th>
                <th>Permissões</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->is_admin ? 'Sim' : 'Não' }}</td>
                    <td>
                        @forelse ($user->permissions as $permission)
                            {{ $permission->name }},
                        @empty
                            Sem permissões
                        @endforelse
                    </td>
                    <td><a href="{{ route('admin.manage_users') }}/{{ $user->id }}">Editar</a></td>
                    <td><a href="#">Excluir</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="paginate">

        {{ $users->links('pagination::bootstrap-4') }}

    </div>

@endsection
