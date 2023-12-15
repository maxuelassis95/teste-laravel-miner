<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Permission;

class AdminController extends Controller
{


    public function index() {
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
        $users = User::with('permissions')->paginate(10);

        return view('admin/manage_user', compact('users'));
    }

    /**
     * Faz a validação e criação do usario
     */
    public function createUsers(Request $request) {



        /**
         * Verifica se o campo do administrador foi marcado
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
        ], [
            'name.required' => 'Digite seu nome',
            'email.required' => 'Digite seu email',
            'email.email' => 'Digite um email válido',
            'email.unique' => 'Este e-mail já esta registrado',
            'password.required' => 'Digite sua senha',
            'password.min' => 'Senha deve ter no minimo 5 caracteres',
        ]);



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


}
