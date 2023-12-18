<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        // Lista todos os usuários com suas permissões
        $users = User::with('permissions')->get();

        return view('admin.manage_permission', compact('users'));
    }

    public function edit($id)
    {
        // Obtém o usuário pelo ID com suas permissões
        $user = User::with('permissions')->find($id);

        // Obtém todas as permissões disponíveis
        $permissions = Permission::all();

        return view('admin.edit_permission', compact('user', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $request->validate([
            'permissions' => 'array|required',
        ], [
            'permissions.required' => 'Usuario deve ter pelo menos uma permissão',
        ]);

        // Encontra o usuário pelo ID
        $user = User::find($id);

        // Atualiza as permissões do usuário
        $permissions = $request->input('permissions', []);
        $user->permissions()->sync($permissions);

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('admin.manage_permissions')->with('success', 'Permissões do usuário atualizadas com sucesso!');
    }
}
