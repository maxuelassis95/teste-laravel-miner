@extends('layout')

@section('content')
    @include('components/admin_header')

    <h3>Editar Permissões de Usuário - {{ $user->name }}</h3>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Exibir mensagens de sucesso ou erro aqui, se necessário --}}

    <form method="POST" action="{{ route('admin.exec_edit_permissions', ['id' => $user->id]) }}" class="permissions-form">
        @csrf

        <label>Selecione as Permissões:</label>
        @foreach ($permissions as $permission)
            <div>
                <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]"
                    value="{{ $permission->id }}" {{ in_array($permission->id, $user->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                <label for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
            </div>
        @endforeach

        <button type="submit">Atualizar Permissões</button>
    </form>

@endsection
