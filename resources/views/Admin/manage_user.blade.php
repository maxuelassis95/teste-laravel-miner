@extends('layout')

@section('content')
    @include('components/admin_header')

    <a href="{{ route('admin.create_users') }}" class="link-create-user">Criar usuário</a>

        <h3>Listando todos usuários</h3>

        {{-- Exibe as mensagens de erro ou sucesso sobre a edição de usuario --}}

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                        <td>
                            <form action="{{ route('admin.delete_users', ['id' => $user->id]) }}" method="post"
                                onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginate">

            {{ $users->links('pagination::bootstrap-4') }}

        </div>
@endsection
