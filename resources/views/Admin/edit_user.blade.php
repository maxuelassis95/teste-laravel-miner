@extends('layout')

@section('content')
    @include('components/admin_header')

    <h3>Editar Informações Básicas do Usuário - {{ $user->name }}</h3>


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

    <form method="POST" action="{{ route('admin.exec_edit_users', ['id' => $user->id]) }}" class="user-form">
        @csrf
        @method('PUT')

        <label for="name">Nome:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

        <label for="email">E-mail:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

        <label for="is_admin">É Administrador?</label>
        <input type="checkbox" name="is_admin" id="is_admin" {{ $user->is_admin ? 'checked' : '' }} onclick="togglePermissions()">

        {{-- Bloco adicional para permissões --}}
        <div id="permissions_block" style="display: none;">
            <label for="permissions">Selecione as permissões:</label>
            @foreach ($permissions as $permission)
                <div>
                    <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]"
                        value="{{ $permission->id }}" {{ in_array($permission->id, $user->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <label for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit">Atualizar Informações Básicas</button>
    </form>

    <script>
        function togglePermissions() {
            const isAdminCheckbox = document.getElementById('is_admin');
            const permissionsBlock = document.getElementById('permissions_block');

            if (isAdminCheckbox.checked) {
                permissionsBlock.style.display = 'none';
            } else {
                permissionsBlock.style.display = 'block';
            }
        }
    </script>
@endsection
