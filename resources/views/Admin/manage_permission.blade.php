@extends('layout')

@section('content')
    @include('components/admin_header')

    <h3>Editar permissões</h3>

    {{-- Exibe as mensagens de erro ou sucesso sobre a edição de permissões --}}
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Permissions</th>
                <th>Edit Permissions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                {{-- Ignora usuários que são administradores --}}
                @if (!$user->is_admin)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            @foreach ($user->permissions as $permission)
                                {{ $permission->name }},
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.edit_permissions', ['id' => $user->id]) }}">Editar permissões</a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection
