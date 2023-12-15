<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        // Verifica se o usuário está autenticado
        if (Auth::check()) {
            // Verificar o nivel de permissao do usuario e redireciona para sua rota
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // Se o usuário não estiver autenticado, mostrar a página inicial
        return view('home');

    }
}
