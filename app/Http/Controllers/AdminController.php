<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Permission;

class AdminController extends Controller
{


    public function index()
    {
        // Busca as permissões do banco de dados
        $permissions = Permission::all();

        /**
         * Chama a view para criar usuario, passando todas as permissões para realizar o cadastro
         */
        return view('admin/create_user', ['permissions' => $permissions]);
    }

    /**
     * Faz a listagem dos usuarios já definindo uma paginação de 10 users por pagina
     */
    public function manageUsers(Request $request)
    {
        /**
         * Lista usuários com suas permissões associadas, paginados de 10 em 10
         */
        $users = User::with('permissions')->paginate(10);

        return view('admin/manage_user', compact('users'));
    }

    /**
     * Faz a validação e criação do usario
     */
    public function createUsers(Request $request)
    {

        /**
         * Se o campo É admin? foi marcado, atribui true a variavel que vou, senão, atribui false.
         * Vou precisar para salvar no banco.
         */
        $is_admin = $request->has('is_admin') ? true : false;

        /**
         * Falta implementar a lógica que vai retornar erro se tentaar cadastras sem ser admin e
         * sem sem adicionar ao menos uma permissão
         */

        // Validação dos dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:5|string',
            'permissions' => 'array',
            'is_admin' => 'required_without:permissions',
            'permissions' => 'required_without:is_admin|array',
        ], [
            'name.required' => 'Digite seu nome',
            'email.required' => 'Digite seu email',
            'email.email' => 'Digite um email válido',
            'email.unique' => 'Este e-mail já esta registrado',
            'password.required' => 'Digite sua senha',
            'password.min' => 'Senha deve ter no minimo 5 caracteres',
            'is_admin.required_without' => 'O cadastrado se não for administrador deverá ter ao menos um permissão marcada',
            'permissions.required_without' => 'O cadastrado se não for administrador deverá ter ao menos um permissão marcada',
        ]);


        //$is_admin = $request->filled('is_admin') ? $request->input('is_admin') : false;

        // Criação do usuário
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'is_admin' => $is_admin,
        ]);

        // Se não for administrador, atribui as permissões selecionadas
        if (!$request->input('is_admin')) {
            $permissions = $request->input('permissions', []);
            $user->permissions()->attach($permissions);
        }

        // Redireciona ou realiza outras ações conforme necessário
        return redirect()->route('admin.create_users')->with('success', 'Usuário criado com sucesso!');
    }

    public function editUsers($id)
    {
        $user = User::find($id);
        //return dd($user);
        $permissions = Permission::all();

        return (view('admin/edit_user', compact('user', 'permissions')));
    }

    public function execEditUsers(Request $request, $id)
    {
        // Encontrar o usuário pelo ID
        $user = User::find($id);

        // Se o usuário não for encontrado, redirecione ou lide com o erro conforme necessário

        // Validação dos dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $id,
            'permissions' => 'array',
            'is_admin' => 'required_without:permissions',
            'is_admin' => 'required_without:permissions',
            'permissions' => 'required_without:is_admin|array',
        ], [
            'name.required' => 'Digite seu nome',
            'email.required' => 'Digite seu email',
            'email.email' => 'Digite um email válido',
            'email.unique' => 'Este e-mail já está registrado',
            'is_admin.required_without' => 'O cadastro, se não for administrador, deve ter ao menos uma permissão marcada',
            'permissions.required_without' => 'O cadastro, se não for administrador, deve ter ao menos uma permissão marcada',
        ]);

        // Atualização do usuário
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : $user->password,
            'is_admin' => $request->has('is_admin') ? true : false,
        ]);

        // Se não for administrador, atualiza as permissões selecionadas
        if (!$request->input('is_admin')) {
            $permissions = $request->input('permissions', []);
            $user->permissions()->sync($permissions);
        } else {
            // Se for administrador remove todas as permissões associadas
            $user->permissions()->detach();
        }

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('admin.edit_users', ['id' => $user->id])->with('success', 'Informações do usuário atualizadas com sucesso!');
        //return redirect()->route('admin.edit_users')->with('success', 'Informações do usuário atualizadas com sucesso!');
    }

    /**
     * Método responsável por excluir usuario
     */
    public function deleteUser($id)
    {
        $user = User::find($id);

        // Verifica se o usuario foi encontrado
        if (!$user) {
            return redirect()->route('admin.manage_users')->with('error', 'Usuário não encontrado.');
        }

        // Exclui o usuario
        $user->delete();

        // Redireciona com a mensagem de sucesso
        return redirect()->route('admin.manage_users')->with('success', 'Usuário excluído com sucesso!');
    }
}
