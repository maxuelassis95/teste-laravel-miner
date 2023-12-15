@extends('layout')

@section('content')
    @include('components/admin_header')

    <h3>Criar Usuário</h3>

    {{-- Exibe as mensagens de erro ou sucesso sobre o cadastro de usuario --}}

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

    <form method="POST" action="{{ route('admin.create_users') }}" class="user-form">
        @csrf

        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required unique>

        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>

        <label for="is_admin">É Administrador?</label>
        <input type="checkbox" name="is_admin" id="is_admin" onclick="togglePermissions()">

        <label class="permissions-label">Quais permissões ele deverá ter?</label>
        <div class="permissions" id="permissions">
            <label for="permissions">Quais permissões ele deverá ter?</label>

            {{-- Pega todas as permissões e deixa permitido para o administrador escolher
                qual o usuario vai ter --}}
            @foreach ($permissions as $permission)
                <div>
                    <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]"
                        value="{{ $permission->id }}">
                    <label for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit">Criar Usuário</button>
    </form>

    <script>
        function togglePermissions() {
            const isAdminCheckbox = document.getElementById('is_admin');
            const permissionsDiv = document.getElementById('permissions');

            // Se o usuário for administrador, desabilita a escolha de permissões
            if (isAdminCheckbox.checked) {
                permissionsDiv.style.display = 'none';

                // Desmarcar todas as caixas de seleção de permissões
                const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
                permissionCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            } else {
                permissionsDiv.style.display = 'block';
            }
        }
    </script>
@endsection
