<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function index()
    {

        /**
         * Se o usuario tentar acessar /login direto pelo
         * navegado, só mostro a view de se ele não estiver logado
         */

        if (Auth::check()) {

            $user = Auth::user();

            /**
            * Se ele estiver logado, verifico seu nivel de acesso para redirecionar para sua rota certa
            */

            if ($user->is_admin) {
                return redirect('/admin');
            } else {
                return redirect('/user');
            }

        } else {
            return view('login');
        }
    }

    public function trylogin(Request $request)
    {

        /**
         * Validação simples dos campos de email e senha
         */

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Digite seu e-mail',
            'email.email' => 'Digite um e-mail válido',
            'password.required' => 'Digite sua senha'
        ]);

        /**
         * Realiza o login
         */

        $credentials = $request->only('email', 'password');
        $authenticated = Auth::attempt($credentials);


        /**
         * Se o usuario colocar informações incorretas ele é redirecionado para a tela de login,
         * informando para ele o erro.
         */

        if (!$authenticated) {
            return redirect()->route('login.index')->withErrors(['error' => 'Email ou senha incorretos']);
        } else {

            //return redirect()->route('home')->with('success', 'Logado');

            /**
             * Se chegar aqui, o usuario está logado, com isso preciso definir se ele é um administrador
             * ou usuario simples. Pra isso eu tenho um campo is_admin na tabela users que registra
             * 0 para usuarios normais e 1 para administradores
             */


            if (Auth::check()) {

                $user = Auth::user();

                if ($user->is_admin) {
                    return redirect('/admin');
                } else {
                    return redirect('/user');
                }
            }

        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
